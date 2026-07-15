<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use DateTime;
use Usgm\Core\Types\Date;

class ShipmentPageDtoDataItem extends JsonSerializableType
{
    /**
     * @var string $id Shipment id (UUID).
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var value-of<ShipmentPageDtoDataItemType> $type
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var value-of<ShipmentPageDtoDataItemStatus> $status Customer-facing status group — `in_progress` covers every internal workflow state between request and shipment.
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
     * @var ?ShipmentPageDtoDataItemDestination $destination Where it ships to. Only present for `shipment` and `check_deposit` types — returns go back to the sender and pickups happen at the facility.
     */
    #[JsonProperty('destination')]
    public ?ShipmentPageDtoDataItemDestination $destination;

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
     * @param array{
     *   id: string,
     *   type: value-of<ShipmentPageDtoDataItemType>,
     *   status: value-of<ShipmentPageDtoDataItemStatus>,
     *   itemCount: int,
     *   createdOn: DateTime,
     *   trackingNumber?: ?string,
     *   serviceName?: ?string,
     *   destination?: ?ShipmentPageDtoDataItemDestination,
     *   requestedShipDate?: ?DateTime,
     *   depositCheckSlipCompanyName?: ?string,
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
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
