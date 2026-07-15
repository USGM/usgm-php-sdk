<?php

namespace Usgm;

use Usgm\Mails\MailsClient;
use Usgm\Scans\ScansClient;
use Usgm\Shipments\ShipmentsClient;
use Usgm\Folders\FoldersClient;
use Usgm\Addresses\AddressesClient;
use Usgm\BankAccounts\BankAccountsClient;
use Usgm\Account\AccountClient;
use Usgm\Sandbox\SandboxClient;
use GuzzleHttp\ClientInterface;
use Usgm\Core\Client\RawClient;

class UsglobalmailClient
{
    /**
     * @var MailsClient $mails
     */
    public MailsClient $mails;

    /**
     * @var ScansClient $scans
     */
    public ScansClient $scans;

    /**
     * @var ShipmentsClient $shipments
     */
    public ShipmentsClient $shipments;

    /**
     * @var FoldersClient $folders
     */
    public FoldersClient $folders;

    /**
     * @var AddressesClient $addresses
     */
    public AddressesClient $addresses;

    /**
     * @var BankAccountsClient $bankAccounts
     */
    public BankAccountsClient $bankAccounts;

    /**
     * @var AccountClient $account
     */
    public AccountClient $account;

    /**
     * @var SandboxClient $sandbox
     */
    public SandboxClient $sandbox;

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
     * @param string $token The token to use for authentication.
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        string $token,
        ?array $options = null,
    ) {
        $defaultHeaders = [
            'Authorization' => "Bearer $token",
            'X-Fern-Language' => 'PHP',
            'X-Fern-SDK-Name' => 'Usgm',
        ];

        $this->options = $options ?? [];
        $this->options['headers'] = array_merge(
            $defaultHeaders,
            $this->options['headers'] ?? [],
        );

        $this->client = new RawClient(
            options: $this->options,
        );

        $this->mails = new MailsClient($this->client, $this->options);
        $this->scans = new ScansClient($this->client, $this->options);
        $this->shipments = new ShipmentsClient($this->client, $this->options);
        $this->folders = new FoldersClient($this->client, $this->options);
        $this->addresses = new AddressesClient($this->client, $this->options);
        $this->bankAccounts = new BankAccountsClient($this->client, $this->options);
        $this->account = new AccountClient($this->client, $this->options);
        $this->sandbox = new SandboxClient($this->client, $this->options);
    }
}
