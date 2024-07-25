<?php

namespace App\Enums;

enum SortProductEnum : string
{
    case POPULARITY = 'popularity';
    case CHEAP = 'cheap';
    case EXPENSIVE = 'expensive';

    public function label()
    {
        return trans("site.$this->value");
    }
}
