<?php

namespace Usgm\Sandbox\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;

/**
 * Item dimensions, in inches.
 */
class SeedSandboxMailDtoMeasurement extends JsonSerializableType
{
    /**
     * @var float $width Inches.
     */
    #[JsonProperty('width')]
    public float $width;

    /**
     * @var float $height Inches.
     */
    #[JsonProperty('height')]
    public float $height;

    /**
     * @var float $length Inches.
     */
    #[JsonProperty('length')]
    public float $length;

    /**
     * @param array{
     *   width: float,
     *   height: float,
     *   length: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->width = $values['width'];
        $this->height = $values['height'];
        $this->length = $values['length'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
