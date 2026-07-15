<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use DateTime;
use Usgm\Core\Types\Date;
use Usgm\Core\Types\ArrayType;

class ShipmentDetailDto extends JsonSerializableType
{
    /**
     * @var string $id Shipment id (UUID).
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var value-of<ShipmentDetailDtoType> $type
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var value-of<ShipmentDetailDtoStatus> $status Customer-facing status group — `in_progress` covers every internal workflow state between request and shipment.
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var ?string $trackingNumber Carrier tracking number, once the shipment is on its way.
     */
    #[JsonProperty('tracking_number')]
    public ?string $trackingNumber;

    /**
     * @var ?string $serviceName Carrier service used (e.g. "FedEx International Priority").
     */
    #[JsonProperty('service_name')]
    public ?string $serviceName;

    /**
     * @var ?ShipmentDetailDtoDestination $destination Where it ships to. Only present for `shipment` and `check_deposit` types — returns go back to the sender and pickups happen at the facility.
     */
    #[JsonProperty('destination')]
    public ?ShipmentDetailDtoDestination $destination;

    /**
     * @var int $itemCount Number of mail items packed into the request.
     */
    #[JsonProperty('item_count')]
    public int $itemCount;

    /**
     * @var ?DateTime $requestedShipDate The ship-out date the customer asked for.
     */
    #[JsonProperty('requested_ship_date'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $requestedShipDate;

    /**
     * @var DateTime $createdOn When the request was made.
     */
    #[JsonProperty('created_on'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdOn;

    /**
     * @var ?string $depositCheckSlipCompanyName `check_deposit` only.
     */
    #[JsonProperty('deposit_check_slip_company_name')]
    public ?string $depositCheckSlipCompanyName;

    /**
     * @var ?string $instructions Packing instructions given when the request was made.
     */
    #[JsonProperty('instructions')]
    public ?string $instructions;

    /**
     * @var bool $isExpedited
     */
    #[JsonProperty('is_expedited')]
    public bool $isExpedited;

    /**
     * @var bool $isInsured
     */
    #[JsonProperty('is_insured')]
    public bool $isInsured;

    /**
     * @var ?float $insuredAmount Insured value in USD. Null when the shipment is not insured.
     */
    #[JsonProperty('insured_amount')]
    public ?float $insuredAmount;

    /**
     * @var float $declaredValue Total declared customs value of the packed items, in USD.
     */
    #[JsonProperty('declared_value')]
    public float $declaredValue;

    /**
     * @var ?string $rejectReason Why the request was rejected. Null unless `status` is `rejected`.
     */
    #[JsonProperty('reject_reason')]
    public ?string $rejectReason;

    /**
     * @var array<ShipmentDetailDtoMailItemsItem> $mailItems
     */
    #[JsonProperty('mail_items'), ArrayType([ShipmentDetailDtoMailItemsItem::class])]
    public array $mailItems;

    /**
     * @param array{
     *   id: string,
     *   type: value-of<ShipmentDetailDtoType>,
     *   status: value-of<ShipmentDetailDtoStatus>,
     *   itemCount: int,
     *   createdOn: DateTime,
     *   isExpedited: bool,
     *   isInsured: bool,
     *   declaredValue: float,
     *   mailItems: array<ShipmentDetailDtoMailItemsItem>,
     *   trackingNumber?: ?string,
     *   serviceName?: ?string,
     *   destination?: ?ShipmentDetailDtoDestination,
     *   requestedShipDate?: ?DateTime,
     *   depositCheckSlipCompanyName?: ?string,
     *   instructions?: ?string,
     *   insuredAmount?: ?float,
     *   rejectReason?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->type = $values['type'];
        $this->status = $values['status'];
        $this->trackingNumber = $values['trackingNumber'] ?? null;
        $this->serviceName = $values['serviceName'] ?? null;
        $this->destination = $values['destination'] ?? null;
        $this->itemCount = $values['itemCount'];
        $this->requestedShipDate = $values['requestedShipDate'] ?? null;
        $this->createdOn = $values['createdOn'];
        $this->depositCheckSlipCompanyName = $values['depositCheckSlipCompanyName'] ?? null;
        $this->instructions = $values['instructions'] ?? null;
        $this->isExpedited = $values['isExpedited'];
        $this->isInsured = $values['isInsured'];
        $this->insuredAmount = $values['insuredAmount'] ?? null;
        $this->declaredValue = $values['declaredValue'];
        $this->rejectReason = $values['rejectReason'] ?? null;
        $this->mailItems = $values['mailItems'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
