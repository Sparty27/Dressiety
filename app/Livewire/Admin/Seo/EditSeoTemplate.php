<?php

namespace App\Livewire\Admin\Seo;

use App\Models\Page;
use App\Models\SeoTemplate;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditSeoTemplate extends Component
{
    public $seoTemplate;

    #[Validate('required|min:1|string')]
    public $title;

    #[Validate('required|min:1|string')]
    public $description;

    public function mount($type)
    {
//        $templatesArray = SeoTemplate::pluck('seoble_type')->toArray();
//
//        if(!in_array($type, $templatesArray))
//            abort(404);

        if(!in_array($type, SeoTemplate::$templates))
            abort(404);

        $this->seoTemplate = SeoTemplate::where('seoble_type', $type)->first();

        $this->title = $this->seoTemplate->title;
        $this->description = $this->seoTemplate->description;
    }

    public function save()
    {
        $this->validate();

        $this->seoTemplate->updateOrCreate([
            'seoble_type' => $this->seoTemplate->seoble_type
        ],
        [
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.seo.edit-seo-template')
            ->layout('components.layouts.admin');
    }
}
