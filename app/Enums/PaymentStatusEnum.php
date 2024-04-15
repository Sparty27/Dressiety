<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{
    case PROCESS = 'in_process';
    case SUCCESS = 'success';
    case FAILED = 'failed';
}
