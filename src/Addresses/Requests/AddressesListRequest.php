<?php

namespace Usgm\Addresses\Requests;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Addresses\Types\AddressesListRequestType;

class AddressesListRequest extends JsonSerializableType
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
     * @var ?value-of<AddressesListRequestType> $type `shipping` = a shipment destination; `deposit` = where check deposits are sent.
     */
    public ?string $type;

    /**
     * @param array{
     *   limit?: ?int,
     *   cursor?: ?string,
     *   type?: ?value-of<AddressesListRequestType>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->limit = $values['limit'] ?? null;
        $this->cursor = $values['cursor'] ?? null;
        $this->type = $values['type'] ?? null;
    }
}
