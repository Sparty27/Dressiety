<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public function mount()
    {

    }

    public function orders()
    {
        $builder = Order::query();

        return $builder->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.orders.orders', ['orders' => $this->orders()])
            ->layout('components.layouts.admin');
    }
}
