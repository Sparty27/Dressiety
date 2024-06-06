<?php

namespace App\Services\PageService;

use App\Models\Page;

class PageService
{
    public function getPage($page)
    {
        $pageTitle = config('page_mappings')[$page] ?? null;

        return $pageTitle ? Page::where('title', $pageTitle)->first() : null;
    }
}
