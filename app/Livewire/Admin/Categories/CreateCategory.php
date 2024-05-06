<?php

namespace App\Livewire\Admin\Categories;

use App\Livewire\Forms\CreateCategoryForm;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCategory extends Component
{
    use WithFileUploads;

    public $open = false;
    public CreateCategoryForm $form;

    public function openCreateModal()
    {
        $this->form->reset();
        $this->form->resetValidation();
        $this->open = true;
    }

    public function closeCreateModal()
    {
        $this->form->reset();
        $this->open = false;
    }

    public function save()
    {
        $this->validate();

        $category = Category::create($this->form->all());

        $category->photos()->create(
            [
                'url' => Storage::url($this->form->photo->store(path: 'public/photos')),
            ]
        );

        $this->open = false;

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.create-category')
            ->layout('components.layouts.admin');
    }
}
