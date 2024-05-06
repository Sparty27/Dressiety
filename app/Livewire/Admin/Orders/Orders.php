<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::get();
    }

    public function render()
    {
        return view('livewire.admin.orders.orders')
            ->layout('components.layouts.admin');
    }
}
