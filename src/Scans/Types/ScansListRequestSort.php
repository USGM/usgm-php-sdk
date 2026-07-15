<?php

namespace Usgm\Scans\Types;

enum ScansListRequestSort: string
{
    case Newest = "newest";
    case Oldest = "oldest";
}
