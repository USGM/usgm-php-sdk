<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use Usgm\Core\Types\ArrayType;

class SeedResultDto extends JsonSerializableType
{
    /**
     * @var array<string> $mailIds Ids of the seeded mail items (numeric strings).
     */
    #[JsonProperty('mail_ids'), ArrayType(['string'])]
    public array $mailIds;

    /**
     * @param array{
     *   mailIds: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->mailIds = $values['mailIds'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
