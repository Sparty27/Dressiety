<?php

namespace App\Livewire\Admin\Categories;

use App\Livewire\Forms\Gallery;
use App\Livewire\Forms\SingleImage;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryForm extends Component
{
    use WithFileUploads;

    public SingleImage $singleImage;

    public $category;

    public function mount(Category $category)
    {
        $this->category = $category->toArray();

        $this->singleImage->setImaginable($category);
    }

    public function updatedSingleImage()
    {
        $this->singleImage->updatedUploadPhoto();
    }

    public function deletePhoto()
    {
        $this->singleImage->deletePhoto();
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

        $model = Category::updateOrCreate([
            'id' => $this->category['id'] ?? ''
        ],
            $this->category
        );

        $this->singleImage->save($model);


        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.category-form')
            ->layout('components.layouts.admin');
    }
}
