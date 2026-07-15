<?php

namespace Usgm\Shipments\Requests;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Shipments\Types\ShipmentsListRequestTypeItem;
use Usgm\Shipments\Types\ShipmentsListRequestStatusItem;

class ShipmentsListRequest extends JsonSerializableType
{
    /**
     * @var ?int $limit Page size, capped at 100.
     */
    public ?int $limit;

    /**
     * @var ?string $cursor Opaque page cursor — the `next_cursor` of the previous response. Omit for the first page.
     */
    public ?string $cursor;

    /**
     * @var ?array<value-of<ShipmentsListRequestTypeItem>> $type
     */
    public ?array $type;

    /**
     * @var ?array<value-of<ShipmentsListRequestStatusItem>> $status
     */
    public ?array $status;

    /**
     * @param array{
     *   limit?: ?int,
     *   cursor?: ?string,
     *   type?: ?array<value-of<ShipmentsListRequestTypeItem>>,
     *   status?: ?array<value-of<ShipmentsListRequestStatusItem>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->limit = $values['limit'] ?? null;
        $this->cursor = $values['cursor'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->status = $values['status'] ?? null;
    }
}
