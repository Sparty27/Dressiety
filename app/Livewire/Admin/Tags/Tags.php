<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Tags extends Component
{
    use WithPagination;

    public $searchText;

    public $sortColumn = 'id';
    public $sortDirection = 'asc';

    public function mount()
    {

    }

    public function toggleSortColumn($column)
    {
        if($this->sortColumn === $column)
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

    public function tags()
    {
        $builder = Tag::query();

        $this->searchQuery($builder);
        $this->sortQuery($builder);

        return $builder->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.tags.tags', ['tags' => $this->tags()])
            ->layout('components.layouts.admin');
    }
}
