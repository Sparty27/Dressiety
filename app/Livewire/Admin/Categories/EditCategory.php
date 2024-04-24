<?php

namespace App\Livewire\Admin\Categories;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Livewire\Forms\CreateCategoryForm;
use App\Livewire\Forms\EditCategoryForm;
use App\Models\Category;
use http\Client\Request;
use Livewire\Component;

class EditCategory extends Component
{
    public Category $category;

    public EditCategoryForm $form;

    public function mount()
    {
        $this->form->name = $this->category->name;
    }

    public function save()
    {
        $this->validate();

        $this->category->update($this->form->all());

        return redirect()->route('admin.categories.show', $this->category);
    }

    public function render()
    {
        return view('livewire.admin.categories.edit-category')
            ->layout('components.layouts.admin');
    }
}
