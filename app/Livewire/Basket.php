<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\Attributes\On;

class Basket extends Component
{
    public $basketProducts;

    public function mount()
    {
        $this->updateProducts();
    }

    #[On('basketUpdated')]
    public function updateProducts()
    {
        $this->basketProducts = basket()->get();
    }

    public function remove($basketProductId)
    {
        $basketProduct = \App\Models\BasketProduct::find($basketProductId);

        if($basketProduct == null)
            return false;

        basket()->remove($basketProduct);
        $this->basketProducts = basket()->get();

        $this->dispatch('showPopup', 'Товар видалено з корзини', 'bg-blue-500', 1000);
        $this->dispatch('basketUpdated');
        $this->dispatch('basketProductRemoved');
    }

    public function increment($basketProductId)
    {
        $basketProduct = \App\Models\BasketProduct::find($basketProductId);

        if($basketProduct == null)
            return false;

        basket()->increment($basketProduct);
        $this->basketProducts = basket()->get();

        $this->dispatch('basketUpdated');
        $this->dispatch('basketProductRemoved');
    }

    public function decrement($basketProductId)
    {
        $basketProduct = \App\Models\BasketProduct::find($basketProductId);

        if($basketProduct == null)
            return false;

        basket()->decrement($basketProduct);
        $this->basketProducts = basket()->get();

        $this->dispatch('basketUpdated');
        $this->dispatch('basketProductRemoved');
    }

    public function render()
    {
        return view('livewire.basket');
    }
}
