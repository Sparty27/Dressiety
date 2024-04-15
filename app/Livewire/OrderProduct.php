<?php

namespace App\Livewire;

use App\Models\OrderProduct as Product;
use Livewire\Component;

class OrderProduct extends Component
{
    public \App\Models\BasketProduct $basketProduct;

    public function render()
    {
        return view('livewire.order-product');
    }
}
