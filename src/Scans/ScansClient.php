<?php

namespace Usgm\Scans;

use GuzzleHttp\ClientInterface;
use Usgm\Core\Client\RawClient;
use Usgm\Scans\Requests\ScansListRequest;
use Usgm\Types\ScanPageDto;
use Usgm\Exceptions\UsglobalmailException;
use Usgm\Exceptions\UsglobalmailApiException;
use Usgm\Core\Json\JsonApiRequest;
use Usgm\Environments;
use Usgm\Core\Client\HttpMethod;
use JsonException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Client\ClientExceptionInterface;
use Usgm\Scans\Requests\CreateScanDto;
use Usgm\Types\ScanDto;
use Usgm\Types\ScanFileDto;
use Usgm\Types\ScanSummaryDto;

class ScansClient
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
     * List your scan and open-and-scan requests, with filtering, search and pagination
     *
     * @param ScansListRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ScanPageDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function list(ScansListRequest $request = new ScansListRequest(), ?array $options = null): ScanPageDto
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
        if ($request->type != null) {
            $query['type'] = $request->type;
        }
        if ($request->mailId != null) {
            $query['mail_id'] = $request->mailId;
        }
        if ($request->search != null) {
            $query['search'] = $request->search;
        }
        if ($request->sort != null) {
            $query['sort'] = $request->sort;
        }
        if ($request->scanned != null) {
            $query['scanned'] = $request->scanned;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "v1/scans",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ScanPageDto::fromJson($json);
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
     * Request a scan or open-and-scan of a mail item; this is a billable action
     *
     * @param CreateScanDto $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ScanDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function create(CreateScanDto $request, ?array $options = null): ScanDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "v1/scans",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ScanDto::fromJson($json);
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
     * Retrieve one scan request by its id, including status and AI label
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
     * @return ScanDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function get(string $id, ?array $options = null): ScanDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "v1/scans/{$id}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ScanDto::fromJson($json);
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
     * Permanently delete a scan and remove its stored file; this cannot be undone
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
     * @return ScanDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function delete(string $id, ?array $options = null): ScanDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "v1/scans/{$id}",
                    method: HttpMethod::DELETE,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ScanDto::fromJson($json);
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
     * Return a short-lived signed URL to download the scanned document; fetch it promptly
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
     * @return ScanFileDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function file(string $id, ?array $options = null): ScanFileDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "v1/scans/{$id}/file",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ScanFileDto::fromJson($json);
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
     * Return the AI-generated label and bullet summary of the scanned document
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
     * @return ScanSummaryDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function summary(string $id, ?array $options = null): ScanSummaryDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "v1/scans/{$id}/summary",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ScanSummaryDto::fromJson($json);
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
     * Cancel a scan request you no longer need. Valid only for scan requests in in_process status
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
     * @return ScanDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function cancel(string $id, ?array $options = null): ScanDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "v1/scans/{$id}/cancel",
                    method: HttpMethod::POST,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ScanDto::fromJson($json);
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
