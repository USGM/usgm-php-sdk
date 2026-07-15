<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use DateTime;
use Usgm\Core\Types\Date;

class ShipmentDetailDtoMailItemsItem extends JsonSerializableType
{
    /**
     * @var string $id Mail item id (numeric string).
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var string $mailType
     */
    #[JsonProperty('mail_type')]
    public string $mailType;

    /**
     * @var ?string $senderName
     */
    #[JsonProperty('sender_name')]
    public ?string $senderName;

    /**
     * @var ?DateTime $arrivalDate When the item arrived at the facility.
     */
    #[JsonProperty('arrival_date'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $arrivalDate;

    /**
     * @var ?string $envelopeImageUrl Photo of the item/envelope.
     */
    #[JsonProperty('envelope_image_url')]
    public ?string $envelopeImageUrl;

    /**
     * @param array{
     *   id: string,
     *   mailType: string,
     *   senderName?: ?string,
     *   arrivalDate?: ?DateTime,
     *   envelopeImageUrl?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->mailType = $values['mailType'];
        $this->senderName = $values['senderName'] ?? null;
        $this->arrivalDate = $values['arrivalDate'] ?? null;
        $this->envelopeImageUrl = $values['envelopeImageUrl'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
