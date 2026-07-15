<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use DateTime;
use Usgm\Core\Types\Date;

class ScanDto extends JsonSerializableType
{
    /**
     * @var string $id Scan id (UUID).
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var string $mailId Id of the scanned mail item (numeric string).
     */
    #[JsonProperty('mail_id')]
    public string $mailId;

    /**
     * @var string $type `SCAN_REQUEST` (scan the item) or `UNBOXING_REQUEST` (open it and scan the contents).
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var string $status `SUBMITTED`, `IN_PROCESS`, `COMPLETED`, `CANCELLED`, `REJECTED`, `DELETED` or `RESTORING`.
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var bool $isExpedited
     */
    #[JsonProperty('is_expedited')]
    public bool $isExpedited;

    /**
     * @var ?string $instruction
     */
    #[JsonProperty('instruction')]
    public ?string $instruction;

    /**
     * @var ?string $rejectReason Why the request was rejected. Null unless `status` is `REJECTED`.
     */
    #[JsonProperty('reject_reason')]
    public ?string $rejectReason;

    /**
     * @var ?string $label Short AI-generated label of the scanned document (e.g. "Insurance"). Null until generated; requires a plan that includes scan labeling.
     */
    #[JsonProperty('label')]
    public ?string $label;

    /**
     * @var ?DateTime $statusUpdatedAt When the current `status` was reached — for completed scans, the completion time.
     */
    #[JsonProperty('status_updated_at'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $statusUpdatedAt;

    /**
     * @var ?DateTime $autoDeleteOn When the scan file is permanently deleted — download it before this date. Null when no deletion is scheduled.
     */
    #[JsonProperty('auto_delete_on'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $autoDeleteOn;

    /**
     * @var DateTime $createdAt
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @var DateTime $updatedAt Last change of any kind — use `status_updated_at` for status timing.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    public DateTime $updatedAt;

    /**
     * @param array{
     *   id: string,
     *   mailId: string,
     *   type: string,
     *   status: string,
     *   isExpedited: bool,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   instruction?: ?string,
     *   rejectReason?: ?string,
     *   label?: ?string,
     *   statusUpdatedAt?: ?DateTime,
     *   autoDeleteOn?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->mailId = $values['mailId'];
        $this->type = $values['type'];
        $this->status = $values['status'];
        $this->isExpedited = $values['isExpedited'];
        $this->instruction = $values['instruction'] ?? null;
        $this->rejectReason = $values['rejectReason'] ?? null;
        $this->label = $values['label'] ?? null;
        $this->statusUpdatedAt = $values['statusUpdatedAt'] ?? null;
        $this->autoDeleteOn = $values['autoDeleteOn'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
