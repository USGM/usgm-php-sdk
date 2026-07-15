<?php

namespace Usgm\Addresses\Types;

enum AddressesGetDefaultRequestType: string
{
    case Shipping = "shipping";
    case Deposit = "deposit";
}
