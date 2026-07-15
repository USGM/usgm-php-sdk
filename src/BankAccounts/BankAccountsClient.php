<?php

namespace Usgm\BankAccounts;

use GuzzleHttp\ClientInterface;
use Usgm\Core\Client\RawClient;
use Usgm\BankAccounts\Requests\BankAccountsListRequest;
use Usgm\Types\BankAccountPageDto;
use Usgm\Exceptions\UsglobalmailException;
use Usgm\Exceptions\UsglobalmailApiException;
use Usgm\Core\Json\JsonApiRequest;
use Usgm\Environments;
use Usgm\Core\Client\HttpMethod;
use JsonException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Client\ClientExceptionInterface;
use Usgm\BankAccounts\Requests\CreateBankAccountDto;
use Usgm\Types\BankAccountDto;
use Usgm\BankAccounts\Requests\UpdateBankAccountDto;

class BankAccountsClient
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
     * List your bank accounts used for check deposits
     *
     * @param BankAccountsListRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return BankAccountPageDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function bankAccountsList(BankAccountsListRequest $request = new BankAccountsListRequest(), ?array $options = null): BankAccountPageDto
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->limit != null) {
            $query['limit'] = $request->limit;
        }
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "v1/bank-accounts",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return BankAccountPageDto::fromJson($json);
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
     * Add a bank account for check deposits; account number is write-only
     *
     * @param CreateBankAccountDto $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return BankAccountDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function bankAccountsCreate(CreateBankAccountDto $request, ?array $options = null): BankAccountDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "v1/bank-accounts",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return BankAccountDto::fromJson($json);
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
     * Retrieve one bank account by id, returning only the last 4 digits
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
     * @return BankAccountDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function bankAccountsGet(string $id, ?array $options = null): BankAccountDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "v1/bank-accounts/{$id}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return BankAccountDto::fromJson($json);
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
     * Permanently delete a bank account; this is destructive and cannot be undone
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
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function bankAccountsDelete(string $id, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "v1/bank-accounts/{$id}",
                    method: HttpMethod::DELETE,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
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
     * Update the bank name, state, or account number on a bank account
     *
     * @param string $id
     * @param UpdateBankAccountDto $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return BankAccountDto
     * @throws UsglobalmailException
     * @throws UsglobalmailApiException
     */
    public function bankAccountsUpdate(string $id, UpdateBankAccountDto $request = new UpdateBankAccountDto(), ?array $options = null): BankAccountDto
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "v1/bank-accounts/{$id}",
                    method: HttpMethod::PATCH,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return BankAccountDto::fromJson($json);
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
