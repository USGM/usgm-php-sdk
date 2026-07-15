<?php

namespace Usgm\Mails\Types;

enum MailsListRequestIsRead: string
{
    case True = "true";
    case False = "false";
}
