<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use DateTime;
use Usgm\Core\Types\Date;

class AccountDto extends JsonSerializableType
{
    /**
     * @var string $id Account id (UUID).
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $email
     */
    #[JsonProperty('email')]
    public string $email;

    /**
     * @var ?string $phoneNumber
     */
    #[JsonProperty('phone_number')]
    public ?string $phoneNumber;

    /**
     * @var ?string $status Account status as reported by USGM (e.g. `APPROVED`, `SUSPENDED`).
     */
    #[JsonProperty('status')]
    public ?string $status;

    /**
     * @var ?string $boxNumber The PMB (private mailbox) number. Null until a mailbox is assigned.
     */
    #[JsonProperty('box_number')]
    public ?string $boxNumber;

    /**
     * @var DateTime $createdAt Registration date.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   email: string,
     *   createdAt: DateTime,
     *   phoneNumber?: ?string,
     *   status?: ?string,
     *   boxNumber?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->email = $values['email'];
        $this->phoneNumber = $values['phoneNumber'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->boxNumber = $values['boxNumber'] ?? null;
        $this->createdAt = $values['createdAt'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
