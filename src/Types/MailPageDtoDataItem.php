<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use DateTime;
use Usgm\Core\Types\Date;

class MailPageDtoDataItem extends JsonSerializableType
{
    /**
     * @var string $id Mail item id (numeric string).
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var ?string $folderId Id of the folder the item is filed in — see `/v1/folders`.
     */
    #[JsonProperty('folder_id')]
    public ?string $folderId;

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
     * @var ?MailPageDtoDataItemScan $scan The scan requested for this item, when one exists.
     */
    #[JsonProperty('scan')]
    public ?MailPageDtoDataItemScan $scan;

    /**
     * @param array{
     *   id: string,
     *   isRead: bool,
     *   mailStatus: string,
     *   mailType: string,
     *   folderId?: ?string,
     *   senderName?: ?string,
     *   recipientName?: ?string,
     *   arrivalDate?: ?DateTime,
     *   envelopeImageUrl?: ?string,
     *   quarantineReason?: ?string,
     *   scan?: ?MailPageDtoDataItemScan,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->folderId = $values['folderId'] ?? null;
        $this->isRead = $values['isRead'];
        $this->mailStatus = $values['mailStatus'];
        $this->mailType = $values['mailType'];
        $this->senderName = $values['senderName'] ?? null;
        $this->recipientName = $values['recipientName'] ?? null;
        $this->arrivalDate = $values['arrivalDate'] ?? null;
        $this->envelopeImageUrl = $values['envelopeImageUrl'] ?? null;
        $this->quarantineReason = $values['quarantineReason'] ?? null;
        $this->scan = $values['scan'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
