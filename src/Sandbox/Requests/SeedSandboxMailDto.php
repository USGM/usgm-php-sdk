<?php

namespace Usgm\Sandbox\Requests;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use Usgm\Sandbox\Types\SeedSandboxMailDtoMailType;
use Usgm\Sandbox\Types\SeedSandboxMailDtoMeasurement;

class SeedSandboxMailDto extends JsonSerializableType
{
    /**
     * @var ?string $senderName
     */
    #[JsonProperty('sender_name')]
    public ?string $senderName;

    /**
     * @var ?value-of<SeedSandboxMailDtoMailType> $mailType Type of the seeded item. `LETTER` and `LARGELETTER` accept a `SCAN_REQUEST`; the rest accept an `UNBOXING_REQUEST`.
     */
    #[JsonProperty('mail_type')]
    public ?string $mailType;

    /**
     * @var ?float $weight Item weight, in pounds.
     */
    #[JsonProperty('weight')]
    public ?float $weight;

    /**
     * @var ?SeedSandboxMailDtoMeasurement $measurement Item dimensions, in inches.
     */
    #[JsonProperty('measurement')]
    public ?SeedSandboxMailDtoMeasurement $measurement;

    /**
     * @param array{
     *   senderName?: ?string,
     *   mailType?: ?value-of<SeedSandboxMailDtoMailType>,
     *   weight?: ?float,
     *   measurement?: ?SeedSandboxMailDtoMeasurement,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->senderName = $values['senderName'] ?? null;
        $this->mailType = $values['mailType'] ?? null;
        $this->weight = $values['weight'] ?? null;
        $this->measurement = $values['measurement'] ?? null;
    }
}
