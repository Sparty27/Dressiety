<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;

class ShowCategory extends Component
{
    public Category $category;

    public function delete()
    {
        $this->category->delete();

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.show-category')
            ->layout('components.layouts.admin');
    }
}
