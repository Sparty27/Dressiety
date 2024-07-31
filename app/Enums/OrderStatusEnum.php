<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case NEW = 'new';
    case PROCESS_ORDER = 'process_order';
    case DONE = 'done';
    case FAILED = 'failed';

    public function label()
    {
        return trans("enums.order_status.label.$this->value");
    }
}
