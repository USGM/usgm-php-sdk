<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use DateTime;
use Usgm\Core\Types\Date;

class FolderListDtoDataItem extends JsonSerializableType
{
    /**
     * @var string $id Folder id (numeric string) — mail items reference it as `folder_id`.
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var ?string $color Hex color like `#4BB94B`.
     */
    #[JsonProperty('color')]
    public ?string $color;

    /**
     * @var DateTime $createdOn
     */
    #[JsonProperty('created_on'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdOn;

    /**
     * @var DateTime $updatedOn
     */
    #[JsonProperty('updated_on'), Date(Date::TYPE_DATETIME)]
    public DateTime $updatedOn;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   createdOn: DateTime,
     *   updatedOn: DateTime,
     *   color?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->color = $values['color'] ?? null;
        $this->createdOn = $values['createdOn'];
        $this->updatedOn = $values['updatedOn'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
