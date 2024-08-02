<?php

namespace App\Livewire\Admin\Orders;

use App\Models\City;
use App\Models\Order;
use App\Models\Warehouse;
use Livewire\Attributes\Validate;
use Livewire\Component;

class OrderForm extends Component
{
    public $order;
    public $orderClass;

    #[Validate('string|regex:/^[0-9]{2} [0-9]{4} [0-9]{4} [0-9]{4}$/')]
    public $ttn;

    #[Validate('required')]
    public City $selectedCity;
    #[Validate('required')]
    public Warehouse $selectedWarehouse;
    public $searchCity;
    public $searchWarehouse;
    public $cities;
    public $warehouses;

    public function mount(Order $order)
    {
        $this->order = $order->toArray();
        $this->orderClass = $order;

        $this->selectedCity = $order->orderDelivery->warehouse->city;
        $this->selectedWarehouse = $order->orderDelivery->warehouse;

        $this->searchWarehouse = $order->orderDelivery->warehouse->name;
        $this->searchCity = $order->orderDelivery->warehouse->city->name;

        $this->cities = City::search($this->searchCity)->take(10)->get();
        $this->warehouses = $this->selectedCity->warehouses()->search($this->searchCity)->take(10)->get();

        $this->ttn = $order->orderDelivery->ttn;
    }

    public function updatedSearchCity($value)
    {
        $this->cities = City::search($value)->take(10)->get();
    }

    public function updatedSearchWarehouse($value)
    {
        $this->warehouses = $this->selectedCity->warehouses()->search($value)->take(10)->get();
    }

    public function selectCity(City $city)
    {
        $this->resetErrorBag('selectedCity');

        $this->searchCity = $city->name;
        $this->selectedCity = $city;

//        $this->selectedWarehouse =

        unset($this->selectedWarehouse);
        $this->searchWarehouse = '';

        $this->warehouses = Warehouse::where('city_ref', $city->ref)->get();
    }

    public function selectWarehouse(Warehouse $warehouse)
    {
        $this->resetErrorBag('selectedWarehouse');

        $this->searchWarehouse = $warehouse->name;
        $this->selectedWarehouse = $warehouse;
    }

    public function save()
    {
        $this->validate();

        $this->orderClass->orderDelivery->update([
            'warehouse_id' => $this->selectedWarehouse->ref,
            'ttn' => $this->ttn,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.orders.order-form')
            ->layout('components.layouts.admin');
    }
}
