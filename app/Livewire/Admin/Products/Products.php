<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::with('category','photo','category.photo')->get();
    }

    public function render()
    {
        return view('livewire.admin.products.products')
            ->layout('components.layouts.admin');
    }
}
