<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Pages extends Component
{
    use WithPagination;

    public $sortColumn = 'id';
    public $sortDirection = 'asc';

    public $searchText;

//    public $categories;

//    public $selectedCategory;

    public $open;

    public $deletePage;

    public function mount()
    {
//        $this->categories = Category::all();
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
//        if($this->selectedCategory != null)
//            $builder->filter($this->selectedCategory);
    }

    public function pages()
    {
        $builder = Page::query();

        $this->sortQuery($builder);
        $this->searchQuery($builder);
        $this->filterQuery($builder);

        return $builder->paginate(10);
    }

    public function toggleDeleteModal(Page $page)
    {
        $this->deletePage = $page;

        $this->open = !$this->open;
    }

    public function delete()
    {
        $this->deletePage->delete();

        return redirect()->route('admin.pages.index');
    }

    public function render()
    {
        return view('livewire.admin.pages.pages', [ 'pages' => $this->pages()])
            ->layout('components.layouts.admin');
    }
}
