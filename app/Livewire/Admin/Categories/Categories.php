<?php

namespace App\Livewire\Admin\Categories;

use App\Http\Requests\CategoryRequest;
use App\Livewire\Forms\CreateCategoryForm;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Categories extends Component
{
    use WithFileUploads;

    public $categories;

    public function mount()
    {
        $this->categories = Category::get();
    }

    public function render()
    {
        return view('livewire.admin.categories.categories')
            ->layout('components.layouts.admin');
    }
}
