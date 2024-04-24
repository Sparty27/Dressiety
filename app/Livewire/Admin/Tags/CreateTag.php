<?php

namespace App\Livewire\Admin\Tags;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateTag extends Component
{
    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $status;

    public function save()
    {
        $this->validate();

        Tag::create([
            'name' => $this->name,
            'status' => $this->status
        ]);

        return redirect()->route('admin.tags.index');
    }

    public function render()
    {
        return view('livewire.admin.tags.create-tag')
            ->layout('components.layouts.admin');;
    }
}
