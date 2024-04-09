<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BasketProduct as Product;

class BasketProduct extends Component
{
    public Product $basketProduct;

    public function remove()
    {
        if($this->basketProduct->id == null)
            return false;

        basket()->remove($this->basketProduct);

        $this->dispatch('basketUpdated');
    }

    public function increment()
    {
        basket()->increment($this->basketProduct);

        $this->dispatch('basketUpdated');
    }

    public function decrement()
    {
        basket()->decrement($this->basketProduct);

        $this->dispatch('basketUpdated');
    }

    public function render()
    {
        return view('livewire.basket-product');
    }
}
