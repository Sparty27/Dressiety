<?php

namespace App\Services\SeoService;

use App\Models\Seo;
use App\Models\SeoTemplate;
use Illuminate\Support\Str;

class SeoService
{
    public function getMeta($model)
    {
        if(!$model)
            return false;

        $seo = $model->seo;

        $seoTemplate = SeoTemplate::where('seoble_type', $model->getTable())->first();

        $seoData = $model->getSeoData();

        $title = $this->prepareField($seo, $seoTemplate, 'title', $seoData);
        $description = $this->prepareField($seo, $seoTemplate, 'description', $seoData);

        return view('parts.meta', [
            'title' => $title,
            'description' => $description
        ]);
    }

    public function prepareField($seo, $seoTemplate, $column, $seoData)
    {
        if($seo == null || $seo->{$column} == '')
        {
            $template = $seoTemplate->{$column};

            foreach($seoData as $key => $value)
            {
                $template = str_replace($key, $value, $template);
            }

            return $template;
        }

        return $seo->{$column};
    }

//    public function format($seo, $seoTemplate, $column, $model)
//    {
//        if($seo == null)
//            return str_replace('{'.$column.'}', $model->name, $seoTemplate->{$column});
//
//        $empty = ($seo->{$column} == null || $seo->{$column} == '');
//        $seo->{$column} = $empty ? $model->name : $seo->{$column};
//
//        if(str_contains($seoTemplate->{$column}, '{'.$column.'}')) {
//            return str_replace('{'.$column.'}', $seo->{$column}, $seoTemplate->{$column});
//        } elseif($empty) {
//            return $seoTemplate->{$column};
//        } else {
//            return $seo->{$column};
//        }
//    }
}
