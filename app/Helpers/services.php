<?php

use App\Services\BasketService\BasketService;
use App\Services\PageService\PageService;
use App\Services\SeoService\SeoService;

if (! function_exists('basket'))
{
    function basket()
    {
        return resolve(BasketService::class);
    }
}

if (! function_exists('seo'))
{
    function seo()
    {
        return resolve(SeoService::class);
    }
}

if (! function_exists('page'))
{
    function page()
    {
        return resolve(PageService::class);
    }
}
