<?php

namespace Usgm\Mails;

use GuzzleHttp\ClientInterface;
use Usgm\Core\Client\RawClient;
use Usgm\Mails\Requests\MailsListRequest;
use Usgm\Types\MailPageDto;
use Usgm\Exceptions\UsglobalmailException;
use Usgm\Exceptions\UsglobalmailApiException;
use Usgm\Core\Json\JsonApiRequest;
use Usgm\Environments;
use Usgm\Core\Client\HttpMethod;
use JsonException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Client\ClientExceptionInterface;
use Usgm\Types\MailDetailDto;
use Usgm\Mails\Requests\UpdateMailDto;

class MailsClient
{
    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
    }

    /**
     * List your mail items with filtering, search, sorting and cursor pagination
     *
     * @param MailsListRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return MailPageDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function list(MailsListRequest $request = new MailsListRequest(), ?array $options = null): MailPageDto
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->limit != null) {
            $query['limit'] = $request->limit;
        }
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        if ($request->status != null) {
            $query['status'] = $request->status;
        }
        if ($request->mailType != null) {
            $query['mail_type'] = $request->mailType;
        }
        if ($request->folderId != null) {
            $query['folder_id'] = $request->folderId;
        }
        if ($request->search != null) {
            $query['search'] = $request->search;
        }
        if ($request->scanStatus != null) {
            $query['scan_status'] = $request->scanStatus;
        }
        if ($request->sort != null) {
            $query['sort'] = $request->sort;
        }
        if ($request->arrived != null) {
            $query['arrived'] = $request->arrived;
        }
        if ($request->isRead != null) {
            $query['is_read'] = $request->isRead;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "v1/mails",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return MailPageDto::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new UsglobalmailException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if ($response === null) {
                throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
            }
            throw new UsglobalmailApiException(
                message: "API request failed",
                statusCode: $response->getStatusCode(),
                body: $response->getBody()->getContents(),
            );
        } catch (ClientExceptionInterface $e) {
            throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
        }
        throw new UsglobalmailApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Retrieve full detail for one mail item, including dimensions, weight and folder
     *
     * @param string $id
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return MailDetailDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function get(string $id, ?array $options = null): MailDetailDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "v1/mails/{$id}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return MailDetailDto::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new UsglobalmailException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if ($response === null) {
                throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
            }
            throw new UsglobalmailApiException(
                message: "API request failed",
                statusCode: $response->getStatusCode(),
                body: $response->getBody()->getContents(),
            );
        } catch (ClientExceptionInterface $e) {
            throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
        }
        throw new UsglobalmailApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Mark the item read/unread and/or move it into a folder
     *
     * @param string $id
     * @param UpdateMailDto $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return MailDetailDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function update(string $id, UpdateMailDto $request = new UpdateMailDto(), ?array $options = null): MailDetailDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "v1/mails/{$id}",
                    method: HttpMethod::PATCH,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return MailDetailDto::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new UsglobalmailException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if ($response === null) {
                throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
            }
            throw new UsglobalmailApiException(
                message: "API request failed",
                statusCode: $response->getStatusCode(),
                body: $response->getBody()->getContents(),
            );
        } catch (ClientExceptionInterface $e) {
            throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
        }
        throw new UsglobalmailApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Move the item out of your active inbox into the archive
     *
     * @param string $id
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return MailDetailDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function archive(string $id, ?array $options = null): MailDetailDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "v1/mails/{$id}/archive",
                    method: HttpMethod::POST,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return MailDetailDto::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new UsglobalmailException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if ($response === null) {
                throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
            }
            throw new UsglobalmailApiException(
                message: "API request failed",
                statusCode: $response->getStatusCode(),
                body: $response->getBody()->getContents(),
            );
        } catch (ClientExceptionInterface $e) {
            throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
        }
        throw new UsglobalmailApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Restore an archived item back to its previous inbox status
     *
     * @param string $id
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return MailDetailDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function unarchive(string $id, ?array $options = null): MailDetailDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "v1/mails/{$id}/unarchive",
                    method: HttpMethod::POST,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return MailDetailDto::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new UsglobalmailException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if ($response === null) {
                throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
            }
            throw new UsglobalmailApiException(
                message: "API request failed",
                statusCode: $response->getStatusCode(),
                body: $response->getBody()->getContents(),
            );
        } catch (ClientExceptionInterface $e) {
            throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
        }
        throw new UsglobalmailApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Request the mailroom to discard the physical item; destructive, reverse with undiscard within 7 days after the discard request. After 7 days the mail item will be permanently and securely shredded and discarded
     *
     * @param string $id
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return MailDetailDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function discard(string $id, ?array $options = null): MailDetailDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "v1/mails/{$id}/discard",
                    method: HttpMethod::POST,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return MailDetailDto::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new UsglobalmailException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if ($response === null) {
                throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
            }
            throw new UsglobalmailApiException(
                message: "API request failed",
                statusCode: $response->getStatusCode(),
                body: $response->getBody()->getContents(),
            );
        } catch (ClientExceptionInterface $e) {
            throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
        }
        throw new UsglobalmailApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Cancel a pending discard request and keep the item
     *
     * @param string $id
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return MailDetailDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function undiscard(string $id, ?array $options = null): MailDetailDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "v1/mails/{$id}/undiscard",
                    method: HttpMethod::POST,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return MailDetailDto::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new UsglobalmailException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if ($response === null) {
                throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
            }
            throw new UsglobalmailApiException(
                message: "API request failed",
                statusCode: $response->getStatusCode(),
                body: $response->getBody()->getContents(),
            );
        } catch (ClientExceptionInterface $e) {
            throw new UsglobalmailException(message: $e->getMessage(), previous: $e);
        }
        throw new UsglobalmailApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
