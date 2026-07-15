<?php

namespace Usgm\Mails\Types;

enum MailsListRequestSort: string
{
    case Newest = "newest";
    case Oldest = "oldest";
}
