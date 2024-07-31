<?php

namespace App\Enums;

enum DeliveryStatusEnum: string
{
    case PROCESS = 'in_process';
    case NOT_SENT = 'not_sent';
    case DELIVERIED = 'deliveried';
    case CANCELED = 'canceled';
    case RETURNED = 'returned';
}
