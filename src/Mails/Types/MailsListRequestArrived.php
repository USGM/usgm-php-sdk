<?php

namespace Usgm\Mails\Types;

enum MailsListRequestArrived: string
{
    case Week = "week";
    case Month = "month";
    case HalfYear = "half_year";
    case Year = "year";
}
