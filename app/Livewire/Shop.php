<?php

namespace App\Livewire;

use App\Models\BasketProduct;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class Shop extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::with('photo')->take(25)->get();
    }

    public function addToBasket(Product $product)
    {
        basket()->set($product);

        $this->dispatch('basketUpdated');
    }

    public function removeFromBasket($productId)
    {
        $basketProduct = basket()->get()->where('product_id', $productId)->first();

        if($basketProduct == null)
            return false;

        basket()->remove($basketProduct);

        $this->dispatch('basketUpdated');
    }

    #[On('basketUpdated')]
    public function render()
    {

        return view('livewire.shop');
    }
}
