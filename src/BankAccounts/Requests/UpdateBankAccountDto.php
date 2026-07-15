<?php

namespace Usgm\BankAccounts\Requests;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;

class UpdateBankAccountDto extends JsonSerializableType
{
    /**
     * @var ?string $bankName
     */
    #[JsonProperty('bank_name')]
    public ?string $bankName;

    /**
     * @var ?string $bankState
     */
    #[JsonProperty('bank_state')]
    public ?string $bankState;

    /**
     * @var ?string $accountNumber Full account number. Write-only — reads return `account_number_last4`.
     */
    #[JsonProperty('account_number')]
    public ?string $accountNumber;

    /**
     * @param array{
     *   bankName?: ?string,
     *   bankState?: ?string,
     *   accountNumber?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->bankName = $values['bankName'] ?? null;
        $this->bankState = $values['bankState'] ?? null;
        $this->accountNumber = $values['accountNumber'] ?? null;
    }
}
