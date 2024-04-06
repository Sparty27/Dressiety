<?php

use App\Services\BasketService\BasketService;

if (! function_exists('basket'))
{
    function basket()
    {
        return resolve(BasketService::class);
    }
}
