<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public $open = false;

    #[Validate('string|regex:/^[0-9]{2} [0-9]{4} [0-9]{4} [0-9]{4}$/')]
    public $ttn;

    public Order $selectedOrder;

    public $selectedOrderStatus;

    public function mount()
    {

    }

    public function updateStatus(Order $order, OrderStatusEnum $status)
    {
        $order->status = $status;
        $order->save();
    }

    public function updatedSelectedOrderStatus()
    {
    }

    public function toggleModal(Order $order)
    {
        if($order?->exists)
        {
            $this->selectedOrder = $order;

            $this->ttn = $order->orderDelivery->ttn;
        }


        $this->open = !$this->open;
    }

    public function saveTTN()
    {
//        if($this->selectedOrder)
//        {
//            $this->selectedOrder->update([
//                'ttn' => $this->selectedTTN,
//            ]);
//        }

//        $this->toggleModal();
        $this->validate();

        $this->selectedOrder->orderDelivery->update([
            'ttn' => $this->ttn,
        ]);

        $this->open = !$this->open;
    }

    public function orders()
    {
        $builder = Order::query();

        $builder->orderBy('created_at', 'desc');

        return $builder->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.orders.orders', ['orders' => $this->orders()])
            ->layout('components.layouts.admin');
    }
}
