<?php

namespace Usgm\BankAccounts\Requests;

use Usgm\Core\Json\JsonSerializableType;

class BankAccountsListRequest extends JsonSerializableType
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
     * @param array{
     *   limit?: ?int,
     *   cursor?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->limit = $values['limit'] ?? null;
        $this->cursor = $values['cursor'] ?? null;
    }
}
