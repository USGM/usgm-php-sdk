<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;

class MailDetailDtoScan extends JsonSerializableType
{
    /**
     * @var string $uuid Scan id — fetch it via `/v1/scans/{uuid}`.
     */
    #[JsonProperty('uuid')]
    public string $uuid;

    /**
     * @var string $status `IN_PROCESS`, `COMPLETED`, `CANCELLED`, `REJECTED`, `DELETED` or `RESTORING`.
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var string $category `SCAN_REQUEST` or `UNBOXING_REQUEST`.
     */
    #[JsonProperty('category')]
    public string $category;

    /**
     * @var ?string $label Short AI-generated label of the scanned document (e.g. "Insurance"). Null until generated; requires a plan that includes scan labeling.
     */
    #[JsonProperty('label')]
    public ?string $label;

    /**
     * @param array{
     *   uuid: string,
     *   status: string,
     *   category: string,
     *   label?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->uuid = $values['uuid'];
        $this->status = $values['status'];
        $this->category = $values['category'];
        $this->label = $values['label'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
