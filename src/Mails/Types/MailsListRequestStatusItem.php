<?php

namespace Usgm\Mails\Types;

enum MailsListRequestStatusItem: string
{
    case Inbox = "inbox";
    case Archived = "archived";
    case Quarantine = "quarantine";
    case DiscardRequest = "discard_request";
}
