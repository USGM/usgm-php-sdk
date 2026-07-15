<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use DateTime;
use Usgm\Core\Types\Date;

class MailDetailDto extends JsonSerializableType
{
    /**
     * @var string $id Mail item id (numeric string).
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var bool $isRead
     */
    #[JsonProperty('is_read')]
    public bool $isRead;

    /**
     * @var string $mailStatus Lifecycle status as reported by the mailroom.
     */
    #[JsonProperty('mail_status')]
    public string $mailStatus;

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
     * @var ?string $recipientName
     */
    #[JsonProperty('recipient_name')]
    public ?string $recipientName;

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
     * @var ?string $quarantineReason
     */
    #[JsonProperty('quarantine_reason')]
    public ?string $quarantineReason;

    /**
     * @var ?MailDetailDtoScan $scan The scan requested for this item, when one exists.
     */
    #[JsonProperty('scan')]
    public ?MailDetailDtoScan $scan;

    /**
     * @var string $mailTypeLabel Human-readable form of `mail_type` (e.g. "Large Letter").
     */
    #[JsonProperty('mail_type_label')]
    public string $mailTypeLabel;

    /**
     * @var MailDetailDtoMeasurement $measurement Item dimensions, in inches.
     */
    #[JsonProperty('measurement')]
    public MailDetailDtoMeasurement $measurement;

    /**
     * @var float $weight Item weight, in pounds.
     */
    #[JsonProperty('weight')]
    public float $weight;

    /**
     * @var ?string $trackingNumber Inbound carrier tracking number, when one was captured.
     */
    #[JsonProperty('tracking_number')]
    public ?string $trackingNumber;

    /**
     * @var ?string $senderAddress
     */
    #[JsonProperty('sender_address')]
    public ?string $senderAddress;

    /**
     * @var bool $hasStorageCharges Whether the item is currently accruing storage charges.
     */
    #[JsonProperty('has_storage_charges')]
    public bool $hasStorageCharges;

    /**
     * @var ?MailDetailDtoFolder $folder
     */
    #[JsonProperty('folder')]
    public ?MailDetailDtoFolder $folder;

    /**
     * @param array{
     *   id: string,
     *   isRead: bool,
     *   mailStatus: string,
     *   mailType: string,
     *   mailTypeLabel: string,
     *   measurement: MailDetailDtoMeasurement,
     *   weight: float,
     *   hasStorageCharges: bool,
     *   senderName?: ?string,
     *   recipientName?: ?string,
     *   arrivalDate?: ?DateTime,
     *   envelopeImageUrl?: ?string,
     *   quarantineReason?: ?string,
     *   scan?: ?MailDetailDtoScan,
     *   trackingNumber?: ?string,
     *   senderAddress?: ?string,
     *   folder?: ?MailDetailDtoFolder,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->isRead = $values['isRead'];
        $this->mailStatus = $values['mailStatus'];
        $this->mailType = $values['mailType'];
        $this->senderName = $values['senderName'] ?? null;
        $this->recipientName = $values['recipientName'] ?? null;
        $this->arrivalDate = $values['arrivalDate'] ?? null;
        $this->envelopeImageUrl = $values['envelopeImageUrl'] ?? null;
        $this->quarantineReason = $values['quarantineReason'] ?? null;
        $this->scan = $values['scan'] ?? null;
        $this->mailTypeLabel = $values['mailTypeLabel'];
        $this->measurement = $values['measurement'];
        $this->weight = $values['weight'];
        $this->trackingNumber = $values['trackingNumber'] ?? null;
        $this->senderAddress = $values['senderAddress'] ?? null;
        $this->hasStorageCharges = $values['hasStorageCharges'];
        $this->folder = $values['folder'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
