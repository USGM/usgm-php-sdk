<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use Usgm\Core\Types\ArrayType;

class MailPageDto extends JsonSerializableType
{
    /**
     * @var array<MailPageDtoDataItem> $data
     */
    #[JsonProperty('data'), ArrayType([MailPageDtoDataItem::class])]
    public array $data;

    /**
     * @var ?string $nextCursor Pass as `?cursor=` to fetch the next page. Null on the last page.
     */
    #[JsonProperty('next_cursor')]
    public ?string $nextCursor;

    /**
     * @var int $totalCount Total number of items matching this query across all pages.
     */
    #[JsonProperty('total_count')]
    public int $totalCount;

    /**
     * @param array{
     *   data: array<MailPageDtoDataItem>,
     *   totalCount: int,
     *   nextCursor?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->data = $values['data'];
        $this->nextCursor = $values['nextCursor'] ?? null;
        $this->totalCount = $values['totalCount'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
