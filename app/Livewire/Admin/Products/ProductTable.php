<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Admin\DataTable\Table;
use App\Livewire\Admin\DataTable\Util\Column;
use App\Livewire\Admin\DataTable\Util\Columns;
use App\Models\Product;

class ProductTable extends Table
{
    public function model(): string
    {
        return Product::class;
    }

    public function columns(): Columns
    {
        return new Columns(new Column('id','name'));
    }
}
