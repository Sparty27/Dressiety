<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Warehouse;
use App\Services\OrderService\MakeOrderService;
use App\Services\OrderService\Models\Customer;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mockery\Exception;

class MakeOrder extends Component
{
    #[Validate('required|string|min:5|max:190')]
    public $email = '';

    #[Validate('required|string|min:8|max:25')]
    public $phone = '';

    #[Validate('required|string|min:5|max:190')]
    public $name = '';

    public City $selectedCity;

    #[Validate('required')]
    public Warehouse $selectedWarehouse;

    public $searchCity;

    public $searchWarehouse;

    public $cities;
    public $warehouses;

    public function mount()
    {
        $this->cities = City::take(10)->get();
        $this->warehouses = Warehouse::take(10)->get();
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
        $this->searchCity = $city->name;
        $this->selectedCity = $city;

        $this->warehouses = Warehouse::take(10)->where('city_ref', $city->ref)->get();
    }

    public function selectWarehouse(Warehouse $warehouse)
    {
        $this->searchWarehouse = $warehouse->name;
        $this->selectedWarehouse = $warehouse;
    }

    public function makeOrder(MakeOrderService $service)
    {
        $this->validate();

        $customer = new Customer($this->name, $this->email, $this->phone);

        try {
            $order = $service->make($customer, $this->selectedWarehouse);

        } catch(Exception $ex) {
            Log::info($ex->getMessage());
        }

        basket()->clear();

    }

    #[On('basketUpdated')]
    public function render()
    {
        return view('livewire.make-order');
    }
}
