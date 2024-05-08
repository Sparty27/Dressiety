<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Category;
use App\Models\Tag;
use Livewire\Component;

class ShowTag extends Component
{
    public Tag $tag;

    public $open = false;

    public function toggleDeleteModal()
    {
        $this->open = !$this->open;
    }

    public function delete()
    {
        $this->tag->delete();

        return redirect()->route('admin.tags.index');
    }

    public function render()
    {
        return view('livewire.admin.tags.show-tag')
            ->layout('components.layouts.admin');
    }
}
