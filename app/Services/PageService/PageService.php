<?php

namespace App\Services\PageService;

use App\Models\Page;
use App\Models\Product;
use App\Models\Seo;

class PageService
{
    public function getPage($page)
    {
        $pageTitle = config('page_mappings')[$page] ?? null;

        return $pageTitle ? Page::where('title', $pageTitle)->first() : null;
    }

    public function getTitle()
    {
        $currentPath = request()->path();

        if(str_contains($currentPath, 'products/'))
        {
            $segments = explode('/', $currentPath);
            $id = end($segments);

            $productName = Seo::where('seoble_type', 'App\Models\Product')->where('seoble_id', $id)->pluck('title')->first();

            if($productName == null)
                $productName = Product::where('id', $id)->pluck('name')->first();

            return $productName;
        }

        foreach(Page::titles as $path => $title)
        {
            if(str_contains($currentPath, $path))
            {
                return $title;
            }
        }

        return config('app.name');
    }
}
