<?php

namespace App\Enums;

enum SortProductEnum : string
{
//    case POPULARITY = 'popularity';
    case CHEAP = 'cheap';
    case EXPENSIVE = 'expensive';

    public function label()
    {
        return trans("enums.sort_products.label.$this->value");
    }

    public function sortColumn()
    {
        return trans("enums.sort_products.column.$this->value");
    }

    public function sortDirection()
    {
        return trans("enums.sort_products.direction.$this->value");
    }
}
