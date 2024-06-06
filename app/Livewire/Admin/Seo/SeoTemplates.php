<?php

namespace App\Livewire\Admin\Seo;

use App\Models\Product;
use App\Models\SeoTemplate;
use Livewire\Component;

class SeoTemplates extends Component
{
    public $title;

    public $description;

    public $model;

    public function mount()
    {
        $this->model = SeoTemplate::where('seoble_type', app(Product::class)->getTable())->first();

        $this->title = $this->model->title ?? '{title}';
        $this->description = $this->model->description ?? '{description}';
    }

    public function save()
    {
        SeoTemplate::updateOrCreate([
            'seoble_type' => $this->model->seoble_type ?? app(Product::class)->getTable()
        ],[
            'title' => $this->title,
            'description' => $this->description
        ]);
    }

    public function render()
    {
        return view('livewire.admin.seo.seo-templates')
            ->layout('components.layouts.admin');
    }
}
