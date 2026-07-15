<?php

namespace Usgm\Addresses\Types;

enum AddressesListRequestType: string
{
    case Shipping = "shipping";
    case Deposit = "deposit";
}
