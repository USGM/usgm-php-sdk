<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use DateTime;
use Usgm\Core\Types\Date;

class ScanFileDto extends JsonSerializableType
{
    /**
     * @var string $url Short-lived signed download URL — fetch promptly, do not store it.
     */
    #[JsonProperty('url')]
    public string $url;

    /**
     * @var DateTime $expiresAt
     */
    #[JsonProperty('expires_at'), Date(Date::TYPE_DATETIME)]
    public DateTime $expiresAt;

    /**
     * @param array{
     *   url: string,
     *   expiresAt: DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->url = $values['url'];
        $this->expiresAt = $values['expiresAt'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
