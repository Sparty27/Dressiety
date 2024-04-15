<?php

namespace App\Enums;

enum DeliveryStatusEnum: string
{
    case PROCESS = 'in_process';
    case DELIVERIED = 'deliveried';
    case CANCELED = 'canceled';
    case RETURNED = 'returned';
}
