<?php

namespace Usgm\Mails\Types;

enum MailsListRequestScanStatusItem: string
{
    case InProcess = "in_process";
    case Cancelled = "cancelled";
    case Rejected = "rejected";
    case Completed = "completed";
    case Deleted = "deleted";
    case Restoring = "restoring";
    case None = "none";
}
