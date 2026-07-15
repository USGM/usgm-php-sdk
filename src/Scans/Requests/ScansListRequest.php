<?php

namespace Usgm\Scans\Requests;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Scans\Types\ScansListRequestStatusItem;
use Usgm\Scans\Types\ScansListRequestTypeItem;
use Usgm\Scans\Types\ScansListRequestSort;
use Usgm\Scans\Types\ScansListRequestScanned;

class ScansListRequest extends JsonSerializableType
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
     * @var ?array<value-of<ScansListRequestStatusItem>> $status
     */
    public ?array $status;

    /**
     * @var ?array<value-of<ScansListRequestTypeItem>> $type `scan` (scan the item) or `open` (open it and scan the contents).
     */
    public ?array $type;

    /**
     * @var ?string $mailId
     */
    public ?string $mailId;

    /**
     * @var ?string $search
     */
    public ?string $search;

    /**
     * @var ?value-of<ScansListRequestSort> $sort
     */
    public ?string $sort;

    /**
     * @var ?value-of<ScansListRequestScanned> $scanned
     */
    public ?string $scanned;

    /**
     * @param array{
     *   limit?: ?int,
     *   cursor?: ?string,
     *   status?: ?array<value-of<ScansListRequestStatusItem>>,
     *   type?: ?array<value-of<ScansListRequestTypeItem>>,
     *   mailId?: ?string,
     *   search?: ?string,
     *   sort?: ?value-of<ScansListRequestSort>,
     *   scanned?: ?value-of<ScansListRequestScanned>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->limit = $values['limit'] ?? null;
        $this->cursor = $values['cursor'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->mailId = $values['mailId'] ?? null;
        $this->search = $values['search'] ?? null;
        $this->sort = $values['sort'] ?? null;
        $this->scanned = $values['scanned'] ?? null;
    }
}
