<?php

namespace App\Livewire\Admin\Categories;

use App\Livewire\Forms\CreateCategoryForm;
use App\Models\Category;
use Livewire\Component;

class CreateCategory extends Component
{
    public CreateCategoryForm $form;

    public function save()
    {
        $this->validate();

        Category::create($this->form->all());

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.create-category')
            ->layout('components.layouts.admin');
    }
}
