<?php

namespace Usgm\Addresses\Types;

enum CreateAddressDtoType: string
{
    case Shipping = "shipping";
    case Deposit = "deposit";
}
