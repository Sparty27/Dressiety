<?php

namespace App\Livewire;

use App\Models\BasketProduct;
use App\Models\Product;
use Livewire\Component;

class Shop extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::take(12)->get();
    }

    public function addToBasket(Product $product)
    {
        basket()->set($product);
    }

    public function render()
    {

        return view('livewire.shop');
    }
}
