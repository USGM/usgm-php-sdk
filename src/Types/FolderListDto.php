<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use Usgm\Core\Types\ArrayType;

class FolderListDto extends JsonSerializableType
{
    /**
     * @var array<FolderListDtoDataItem> $data
     */
    #[JsonProperty('data'), ArrayType([FolderListDtoDataItem::class])]
    public array $data;

    /**
     * @param array{
     *   data: array<FolderListDtoDataItem>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->data = $values['data'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
