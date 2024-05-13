<?php

namespace App\Livewire\Admin\Categories;

use App\Http\Requests\CategoryRequest;
use App\Livewire\Forms\CreateCategoryForm;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $searchText;

    public $sortColumn = 'id';
    public $sortDirection = 'asc';

    public $deleteCategory;

    public $open;

    public function mount()
    {

    }

    public function toggleSortColumn($column)
    {
        if($this->sortColumn == $column)
        {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';

            return;
        }

        $this->sortColumn = $column;
        $this->sortDirection = 'asc';
    }

    public function searchQuery(Builder $builder)
    {
        $builder->search($this->searchText);
    }

    public function sortQuery(Builder $builder)
    {
        $builder->sort($this->sortColumn, $this->sortDirection);
    }

    public function categories()
    {
        $builder = Category::query();

        $this->searchQuery($builder);
        $this->sortQuery($builder);

        return $builder->paginate(10);
    }

    public function toggleDeleteModal(Category $category)
    {
        $this->deleteCategory = $category;

        $this->open = !$this->open;
    }

    public function delete()
    {
        $this->deleteCategory->delete();

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.categories', ['categories' => $this->categories()])
            ->layout('components.layouts.admin');
    }
}
