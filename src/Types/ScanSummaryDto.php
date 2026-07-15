<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use Usgm\Core\Types\ArrayType;

class ScanSummaryDto extends JsonSerializableType
{
    /**
     * @var ?string $label Short AI-generated label of the document (e.g. "Insurance").
     */
    #[JsonProperty('label')]
    public ?string $label;

    /**
     * @var ?array<string> $summary AI-generated summary of the document contents, one bullet point per entry.
     */
    #[JsonProperty('summary'), ArrayType(['string'])]
    public ?array $summary;

    /**
     * @param array{
     *   label?: ?string,
     *   summary?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->label = $values['label'] ?? null;
        $this->summary = $values['summary'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
