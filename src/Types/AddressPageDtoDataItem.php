<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;

class AddressPageDtoDataItem extends JsonSerializableType
{
    /**
     * @var string $id Address id (UUID).
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var value-of<AddressPageDtoDataItemType> $type `shipping` = a shipment destination; `deposit` = where check deposits are sent.
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var ?string $name Recipient name on the address.
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @var ?string $line1
     */
    #[JsonProperty('line1')]
    public ?string $line1;

    /**
     * @var ?string $line2
     */
    #[JsonProperty('line2')]
    public ?string $line2;

    /**
     * @var ?string $city
     */
    #[JsonProperty('city')]
    public ?string $city;

    /**
     * @var ?string $state
     */
    #[JsonProperty('state')]
    public ?string $state;

    /**
     * @var ?string $postalCode
     */
    #[JsonProperty('postal_code')]
    public ?string $postalCode;

    /**
     * @var ?string $country
     */
    #[JsonProperty('country')]
    public ?string $country;

    /**
     * @var ?string $line3
     */
    #[JsonProperty('line3')]
    public ?string $line3;

    /**
     * @var ?string $phoneNumber
     */
    #[JsonProperty('phone_number')]
    public ?string $phoneNumber;

    /**
     * @var ?string $taxId
     */
    #[JsonProperty('tax_id')]
    public ?string $taxId;

    /**
     * @var bool $isDefault The default address of its `type` — one per type.
     */
    #[JsonProperty('is_default')]
    public bool $isDefault;

    /**
     * @param array{
     *   id: string,
     *   type: value-of<AddressPageDtoDataItemType>,
     *   isDefault: bool,
     *   name?: ?string,
     *   line1?: ?string,
     *   line2?: ?string,
     *   city?: ?string,
     *   state?: ?string,
     *   postalCode?: ?string,
     *   country?: ?string,
     *   line3?: ?string,
     *   phoneNumber?: ?string,
     *   taxId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->type = $values['type'];
        $this->name = $values['name'] ?? null;
        $this->line1 = $values['line1'] ?? null;
        $this->line2 = $values['line2'] ?? null;
        $this->city = $values['city'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->postalCode = $values['postalCode'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->line3 = $values['line3'] ?? null;
        $this->phoneNumber = $values['phoneNumber'] ?? null;
        $this->taxId = $values['taxId'] ?? null;
        $this->isDefault = $values['isDefault'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
