<?php

namespace Usgm\Types;

enum ShipmentPageDtoDataItemStatus: string
{
    case Shipped = "shipped";
    case InProgress = "in_progress";
    case PaymentFailed = "payment_failed";
    case Rejected = "rejected";
}
