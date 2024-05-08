<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditTag extends Component
{
    public Tag $tag;

    #[Validate('required|min:3')]
    public $name;

    #[Validate('required')]
    public $status;

    public function mount()
    {
        $this->name = $this->tag->name;
        $this->status = $this->tag->status;
    }

    public function save()
    {
        $this->validate();

        $this->tag->update([
            'name' => $this->name,
            'status' => $this->status,
        ]);

        return redirect()->route('admin.tags.show', $this->tag);
    }

    public function render()
    {
        return view('livewire.admin.tags.edit-tag')
            ->layout('components.layouts.admin');;
    }
}
