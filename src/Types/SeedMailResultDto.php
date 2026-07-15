<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;

class SeedMailResultDto extends JsonSerializableType
{
    /**
     * @var string $mailId Id of the seeded mail item (numeric string).
     */
    #[JsonProperty('mail_id')]
    public string $mailId;

    /**
     * @param array{
     *   mailId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->mailId = $values['mailId'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
