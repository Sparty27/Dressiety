<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;

class PageForm extends Component
{
    public $page;

    public function mount(Page $page)
    {
        $this->page = $page->toArray();
    }

    public function rules()
    {
        return [
            'page.title' => 'required|string|min:3|max:250',
            'page.description' => 'required|string|min:3|max:2500',
        ];
    }

    public function save()
    {
        $this->validate();

        $model = Page::updateOrCreate([
            'id' => $this->page['id'] ?? '',
        ],
            $this->page
        );

        return redirect()->route('admin.pages.index');
    }

    public function render()
    {
        return view('livewire.admin.pages.page-form')
            ->layout('components.layouts.admin');
    }
}
