<?php

namespace App\Services\SeoService;

use App\Models\Seo;
use App\Models\SeoTemplate;

class SeoService
{
//    public function getSeoData($model)
//    {
//        $modelType = get_class($model);
//        $modelId = $model->id;
//
//        $seo = Seo::where('seoble_type', $modelType)
//            ->where('seoble_id', $modelId)
//            ->first();
//
//        if (!$seo) {
//            $template = SeoTemplate::where('seoble_type', $modelType)->first();
//            $seo = new Seo([
//                'title' => $template->default_title,
//                'description' => $template->default_description,
//            ]);
//        }
//
//        return $seo;
//    }

    public function getMeta($model)
    {
        $seo = Seo::where('seoble_type', get_class($model))
            ->where('seoble_id', $model->id)
            ->first();

        $seoTemplate = SeoTemplate::where('seoble_type', $model->getTable())->first();

        $title = $this->format($seo, $seoTemplate, 'title', $model);
        $description = $this->format($seo, $seoTemplate, 'description', $model);

        return view('parts.meta', [
            'title' => $title,
            'description' => $description
        ]);
    }

    public function format($seo, $seoTemplate, $column, $model)
    {
        if($seo == null)
            return str_replace('{'.$column.'}', $model->name, $seoTemplate->{$column});

        $empty = ($seo->{$column} == null || $seo->{$column} == '');
        $seo->{$column} = $empty ? $model->name : $seo->{$column};

        if(str_contains($seoTemplate->{$column}, '{'.$column.'}')) {
            return str_replace('{'.$column.'}', $seo->{$column}, $seoTemplate->{$column});
        } elseif($empty) {
            return $seoTemplate->{$column};
        } else {
            return $seo->{$column};
        }
    }
}
