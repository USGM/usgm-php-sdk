<?php

namespace Usgm\Mails\Requests;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;

class UpdateMailDto extends JsonSerializableType
{
    /**
     * @var ?bool $isRead
     */
    #[JsonProperty('is_read')]
    public ?bool $isRead;

    /**
     * @var ?string $folderId Move the item to this folder. Pass null to remove it from its folder.
     */
    #[JsonProperty('folder_id')]
    public ?string $folderId;

    /**
     * @param array{
     *   isRead?: ?bool,
     *   folderId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->isRead = $values['isRead'] ?? null;
        $this->folderId = $values['folderId'] ?? null;
    }
}
