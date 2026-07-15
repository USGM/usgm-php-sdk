<?php

namespace Usgm\Shipments\Types;

enum ShipmentsListRequestStatusItem: string
{
    case Shipped = "shipped";
    case InProgress = "in_progress";
    case PaymentFailed = "payment_failed";
    case Rejected = "rejected";
}
