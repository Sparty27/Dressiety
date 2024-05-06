<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Admin\DataTable\Utils\Column;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $sortColumn = 'id';
    public $sortDirection = 'asc';

    public $searchText;

    public $categories;

    public $selectedCategory;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function toggleSortColumn($column)
    {
        if($column === $this->sortColumn)
        {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';

            return;
        }

        $this->sortColumn = $column;
        $this->sortDirection = 'asc';
    }

    public function sortQuery(Builder $builder)
    {
        $builder->sort($this->sortColumn, $this->sortDirection);
    }

    public function searchQuery(Builder $builder)
    {
        $builder->search($this->searchText);
    }

    public function filterQuery(Builder $builder)
    {
        if($this->selectedCategory != null)
            $builder->filter($this->selectedCategory);
    }

    public function products()
    {
        $builder = Product::with('category','photo','category.photo');

        $this->sortQuery($builder);
        $this->searchQuery($builder);
        $this->filterQuery($builder);

        return $builder->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.products.products', ['products' => $this->products()])
            ->layout('components.layouts.admin');
    }
}
