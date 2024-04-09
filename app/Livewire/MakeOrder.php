<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Warehouse;
use Livewire\Attributes\Validate;
use Livewire\Component;

class MakeOrder extends Component
{
    #[Validate('required')]
    public $email = '';

    #[Validate('required')]
    public $phone = '';

    #[Validate('required')]
    public $name = '';

    #[Validate('required')]
    public $warehouseId = '';

    public City $selectedCity;
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
    }

    public function selectWarehouse(Warehouse $warehouse)
    {
        $this->searchWarehouse = $warehouse->name;
        $this->selectedWarehouse = $warehouse;
    }

    public function makeOrder()
    {
        dd($this->searchCity);
    }

    public function render()
    {
        return view('livewire.make-order');
    }
}
