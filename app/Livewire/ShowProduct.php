<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\SeoService\SeoService;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowProduct extends Component
{
    public Product $product;

    public function mount(SeoService $service)
    {

    }

    public function addToBasket(Product $product)
    {
        basket()->set($product);

        $this->dispatch('basketUpdated');
    }

    #[On('basketUpdated')]
    public function render()
    {
        return view('livewire.show-product');
    }
}
