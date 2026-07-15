<?php

namespace Usgm\Mails\Requests;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Mails\Types\MailsListRequestStatusItem;
use Usgm\Mails\Types\MailsListRequestMailTypeItem;
use Usgm\Mails\Types\MailsListRequestScanStatusItem;
use Usgm\Mails\Types\MailsListRequestSort;
use Usgm\Mails\Types\MailsListRequestArrived;
use Usgm\Mails\Types\MailsListRequestIsRead;

class MailsListRequest extends JsonSerializableType
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
     * @var ?array<value-of<MailsListRequestStatusItem>> $status
     */
    public ?array $status;

    /**
     * @var ?array<value-of<MailsListRequestMailTypeItem>> $mailType
     */
    public ?array $mailType;

    /**
     * @var ?int $folderId
     */
    public ?int $folderId;

    /**
     * @var ?string $search
     */
    public ?string $search;

    /**
     * @var ?array<value-of<MailsListRequestScanStatusItem>> $scanStatus Filter by the item’s scan state; `none` selects items with no scan.
     */
    public ?array $scanStatus;

    /**
     * @var ?value-of<MailsListRequestSort> $sort
     */
    public ?string $sort;

    /**
     * @var ?value-of<MailsListRequestArrived> $arrived
     */
    public ?string $arrived;

    /**
     * @var ?value-of<MailsListRequestIsRead> $isRead
     */
    public ?string $isRead;

    /**
     * @param array{
     *   limit?: ?int,
     *   cursor?: ?string,
     *   status?: ?array<value-of<MailsListRequestStatusItem>>,
     *   mailType?: ?array<value-of<MailsListRequestMailTypeItem>>,
     *   folderId?: ?int,
     *   search?: ?string,
     *   scanStatus?: ?array<value-of<MailsListRequestScanStatusItem>>,
     *   sort?: ?value-of<MailsListRequestSort>,
     *   arrived?: ?value-of<MailsListRequestArrived>,
     *   isRead?: ?value-of<MailsListRequestIsRead>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->limit = $values['limit'] ?? null;
        $this->cursor = $values['cursor'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->mailType = $values['mailType'] ?? null;
        $this->folderId = $values['folderId'] ?? null;
        $this->search = $values['search'] ?? null;
        $this->scanStatus = $values['scanStatus'] ?? null;
        $this->sort = $values['sort'] ?? null;
        $this->arrived = $values['arrived'] ?? null;
        $this->isRead = $values['isRead'] ?? null;
    }
}
