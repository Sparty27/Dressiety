<?php

namespace App\Enums;

enum EmailTemplateEnum: string
{
    case ORDERED = 'Ordered';
    case SHIPPING = 'Shipping';
    case PASSWORD_RESET = 'Password Reset';
}
