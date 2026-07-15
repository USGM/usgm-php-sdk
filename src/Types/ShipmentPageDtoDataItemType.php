<?php

namespace Usgm\Types;

enum ShipmentPageDtoDataItemType: string
{
    case Shipment = "shipment";
    case ReturnToSender = "return_to_sender";
    case CheckDeposit = "check_deposit";
    case Pickup = "pickup";
}
