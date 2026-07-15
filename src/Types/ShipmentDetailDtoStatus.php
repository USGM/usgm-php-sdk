<?php

namespace Usgm\Types;

enum ShipmentDetailDtoStatus: string
{
    case Shipped = "shipped";
    case InProgress = "in_progress";
    case PaymentFailed = "payment_failed";
    case Rejected = "rejected";
}
