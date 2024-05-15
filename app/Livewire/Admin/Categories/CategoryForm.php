<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;

class CategoryForm extends Component
{
    public $category;

    public function mount(Category $category)
    {
        $this->category = $category->toArray();
    }

    public function rules()
    {
        return [
            'category.name' => 'required|string|min:3|max:100',
        ];
    }

    public function save()
    {
        $this->validate();

        Category::updateOrCreate([
            'id' => $this->category['id'] ?? ''
        ],
            $this->category
        );

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.category-form')
            ->layout('components.layouts.admin');
    }
}
