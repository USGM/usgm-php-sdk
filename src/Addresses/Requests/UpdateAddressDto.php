<?php

namespace Usgm\Addresses\Requests;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Addresses\Types\UpdateAddressDtoType;
use Usgm\Core\Json\JsonProperty;

class UpdateAddressDto extends JsonSerializableType
{
    /**
     * @var ?value-of<UpdateAddressDtoType> $type `shipping` = a shipment destination; `deposit` = where check deposits are sent.
     */
    #[JsonProperty('type')]
    public ?string $type;

    /**
     * @var ?string $name
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
     * @var ?string $line3
     */
    #[JsonProperty('line3')]
    public ?string $line3;

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
     * @param array{
     *   type?: ?value-of<UpdateAddressDtoType>,
     *   name?: ?string,
     *   line1?: ?string,
     *   line2?: ?string,
     *   line3?: ?string,
     *   city?: ?string,
     *   state?: ?string,
     *   postalCode?: ?string,
     *   country?: ?string,
     *   phoneNumber?: ?string,
     *   taxId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->type = $values['type'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->line1 = $values['line1'] ?? null;
        $this->line2 = $values['line2'] ?? null;
        $this->line3 = $values['line3'] ?? null;
        $this->city = $values['city'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->postalCode = $values['postalCode'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->phoneNumber = $values['phoneNumber'] ?? null;
        $this->taxId = $values['taxId'] ?? null;
    }
}
