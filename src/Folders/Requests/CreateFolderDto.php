<?php

namespace Usgm\Folders\Requests;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;

class CreateFolderDto extends JsonSerializableType
{
    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var ?string $color
     */
    #[JsonProperty('color')]
    public ?string $color;

    /**
     * @param array{
     *   name: string,
     *   color?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->color = $values['color'] ?? null;
    }
}
