<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
use Livewire\Component;

class ShowTag extends Component
{
    public Tag $tag;

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
