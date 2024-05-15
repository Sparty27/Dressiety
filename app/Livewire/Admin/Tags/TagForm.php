<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
use Livewire\Component;

class TagForm extends Component
{
    public $tag;

    public function mount(Tag $tag)
    {
        $this->tag = $tag->toArray();

        $this->tag['status'] = $this->tag['status'] ?? false;
    }

    public function rules()
    {
        return [
            'tag.name' => 'required|string|min:3|max:100',
        ];
    }

    public function save()
    {
        $this->validate();

        Tag::updateOrCreate([
            'id' => $this->tag['id'] ?? ''
        ],
            $this->tag
        );

        return redirect()->route('admin.tags.index');
    }

    public function render()
    {
        return view('livewire.admin.tags.tag-form')
            ->layout('components.layouts.admin');
    }
}
