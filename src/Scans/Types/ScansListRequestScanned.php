<?php

namespace Usgm\Scans\Types;

enum ScansListRequestScanned: string
{
    case Week = "week";
    case Month = "month";
    case HalfYear = "half_year";
    case Year = "year";
}
