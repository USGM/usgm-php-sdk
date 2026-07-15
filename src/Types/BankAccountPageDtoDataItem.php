<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;

class BankAccountPageDtoDataItem extends JsonSerializableType
{
    /**
     * @var string $id Bank account id (UUID).
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var string $bankName
     */
    #[JsonProperty('bank_name')]
    public string $bankName;

    /**
     * @var string $bankState
     */
    #[JsonProperty('bank_state')]
    public string $bankState;

    /**
     * @var string $accountNumberLast4 Last 4 characters of the account number. The full number is write-only and never returned.
     */
    #[JsonProperty('account_number_last4')]
    public string $accountNumberLast4;

    /**
     * @param array{
     *   id: string,
     *   bankName: string,
     *   bankState: string,
     *   accountNumberLast4: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->bankName = $values['bankName'];
        $this->bankState = $values['bankState'];
        $this->accountNumberLast4 = $values['accountNumberLast4'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
