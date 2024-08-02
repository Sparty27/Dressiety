<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\BasketProduct as Product;

class BasketProduct extends Component
{
    public Product $basketProduct;

    public function remove()
    {
        if($this->basketProduct == null)
            return false;

        basket()->remove($this->basketProduct);
        $this->dispatch('showPopup', 'Видалено з корзини', 'bg-green-500', 1000);

        $this->dispatch('basketUpdated');
        $this->dispatch('basketProductRemoved');
    }

    public function increment()
    {
        basket()->increment($this->basketProduct);

        $this->dispatch('basketUpdated');
        $this->dispatch('basketProductRemoved');
    }

    public function decrement()
    {
        basket()->decrement($this->basketProduct);

        $this->dispatch('basketUpdated');
        $this->dispatch('basketProductRemoved');
    }

    public function render()
    {
        return view('livewire.basket-product');
    }
}
