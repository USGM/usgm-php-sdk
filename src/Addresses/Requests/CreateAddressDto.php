<?php

namespace Usgm\Addresses\Requests;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Addresses\Types\CreateAddressDtoType;
use Usgm\Core\Json\JsonProperty;

class CreateAddressDto extends JsonSerializableType
{
    /**
     * @var value-of<CreateAddressDtoType> $type `shipping` = a shipment destination; `deposit` = where check deposits are sent.
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $line1
     */
    #[JsonProperty('line1')]
    public string $line1;

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
     * @var string $city
     */
    #[JsonProperty('city')]
    public string $city;

    /**
     * @var string $state
     */
    #[JsonProperty('state')]
    public string $state;

    /**
     * @var string $postalCode
     */
    #[JsonProperty('postal_code')]
    public string $postalCode;

    /**
     * @var string $country
     */
    #[JsonProperty('country')]
    public string $country;

    /**
     * @var string $phoneNumber
     */
    #[JsonProperty('phone_number')]
    public string $phoneNumber;

    /**
     * @var ?string $taxId
     */
    #[JsonProperty('tax_id')]
    public ?string $taxId;

    /**
     * @param array{
     *   type: value-of<CreateAddressDtoType>,
     *   name: string,
     *   line1: string,
     *   city: string,
     *   state: string,
     *   postalCode: string,
     *   country: string,
     *   phoneNumber: string,
     *   line2?: ?string,
     *   line3?: ?string,
     *   taxId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->name = $values['name'];
        $this->line1 = $values['line1'];
        $this->line2 = $values['line2'] ?? null;
        $this->line3 = $values['line3'] ?? null;
        $this->city = $values['city'];
        $this->state = $values['state'];
        $this->postalCode = $values['postalCode'];
        $this->country = $values['country'];
        $this->phoneNumber = $values['phoneNumber'];
        $this->taxId = $values['taxId'] ?? null;
    }
}
