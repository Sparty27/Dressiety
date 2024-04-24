<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
use Livewire\Component;

class Tags extends Component
{
    public $tags;

    public function mount()
    {
        $this->tags = Tag::get();
    }

    public function render()
    {
        return view('livewire.admin.tags.tags')
            ->layout('components.layouts.admin');
    }
}
