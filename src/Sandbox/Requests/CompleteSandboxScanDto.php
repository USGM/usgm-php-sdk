<?php

namespace Usgm\Sandbox\Requests;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use Usgm\Core\Types\ArrayType;

class CompleteSandboxScanDto extends JsonSerializableType
{
    /**
     * @var ?string $label Short document label the AI would produce, e.g. "Insurance". Set on the scan.
     */
    #[JsonProperty('label')]
    public ?string $label;

    /**
     * @var ?array<string> $summary Summary bullet points; retrievable via `GET /v1/scans/{id}/summary`.
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
}
