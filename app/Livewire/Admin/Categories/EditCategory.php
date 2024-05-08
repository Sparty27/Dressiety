<?php

namespace App\Livewire\Admin\Categories;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Livewire\Forms\CategoryForm;
use App\Livewire\Forms\CreateCategoryForm;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCategory extends Component
{
    use WithFileUploads;

    public Category $category;

    #[Validate('required|min:3|max:100')]
    public $name = '';

    #[Validate('image|max:36000')]
    public $photo = '';

    public function mount()
    {
        $this->name = $this->category->name;
    }

    public function save()
    {
        $this->validate();

        if($this->photo)
        {
            if($this->category->photo != null)
                $this->category->photo->update(['url' => Storage::url($this->photo->store(path: 'public/photos'))]);
            else
                $this->category->photo()->create(['url' => Storage::url($this->photo->store(path: 'public/photos'))]);
        }

        $this->category->update(
            [
                'name' => $this->name,
            ]
        );

        return redirect()->route('admin.categories.show', $this->category);
    }

    public function render()
    {
        return view('livewire.admin.categories.edit-category')
            ->layout('components.layouts.admin');
    }
}
