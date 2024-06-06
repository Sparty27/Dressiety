<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use App\Models\Seo;
use Livewire\Component;

class SeoPage extends Component
{
    public $page;
    public $title;
    public $description;
    private $seo;

    public function mount(Page $page)
    {
        $this->page = $page;

        $this->seo = $seo = Seo::where('seoble_type', get_class($page))
            ->where('seoble_id', $page->id)
            ->first();

        if($seo)
        {
            $this->title = $seo->title;
            $this->description = $seo->description;
        }
    }

    public function save()
    {
        $this->page->seo()->updateOrCreate(
            [
                'seoble_id' => $this->page->id,
                'seoble_type' => get_class($this->page),
            ],
            [
                'title' => $this->title,
                'description' => $this->description,
            ]);

        return redirect()->route('admin.pages.index');
    }

    public function render()
    {
        return view('livewire.admin.pages.seo-page')
            ->layout('components.layouts.admin');
    }
}
