<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;

class MailingAddressDto extends JsonSerializableType
{
    /**
     * @var string $boxNumber The PMB (private mailbox) number — include it on every inbound mail piece.
     */
    #[JsonProperty('box_number')]
    public string $boxNumber;

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
     * @var string $formatted The complete address on one line, ready to hand out: "<line1> PMB <box>, <city>, <state>, <postal_code>, <country>".
     */
    #[JsonProperty('formatted')]
    public string $formatted;

    /**
     * @param array{
     *   boxNumber: string,
     *   formatted: string,
     *   line1?: ?string,
     *   line2?: ?string,
     *   line3?: ?string,
     *   city?: ?string,
     *   state?: ?string,
     *   postalCode?: ?string,
     *   country?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->boxNumber = $values['boxNumber'];
        $this->line1 = $values['line1'] ?? null;
        $this->line2 = $values['line2'] ?? null;
        $this->line3 = $values['line3'] ?? null;
        $this->city = $values['city'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->postalCode = $values['postalCode'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->formatted = $values['formatted'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
