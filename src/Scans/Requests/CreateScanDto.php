<?php

namespace Usgm\Scans\Requests;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use Usgm\Scans\Types\CreateScanDtoType;

class CreateScanDto extends JsonSerializableType
{
    /**
     * @var string $mailId
     */
    #[JsonProperty('mail_id')]
    public string $mailId;

    /**
     * @var value-of<CreateScanDtoType> $type `scan` scans the item as-is; `open` opens it and scans the contents.
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var ?string $instruction
     */
    #[JsonProperty('instruction')]
    public ?string $instruction;

    /**
     * @var ?bool $isExpedited Expedited handling — may incur an extra charge.
     */
    #[JsonProperty('is_expedited')]
    public ?bool $isExpedited;

    /**
     * @param array{
     *   mailId: string,
     *   type: value-of<CreateScanDtoType>,
     *   instruction?: ?string,
     *   isExpedited?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->mailId = $values['mailId'];
        $this->type = $values['type'];
        $this->instruction = $values['instruction'] ?? null;
        $this->isExpedited = $values['isExpedited'] ?? null;
    }
}
