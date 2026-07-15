<?php

namespace Usgm\Addresses\Types;

enum UpdateAddressDtoType: string
{
    case Shipping = "shipping";
    case Deposit = "deposit";
}
