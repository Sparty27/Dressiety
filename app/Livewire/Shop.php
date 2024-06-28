<?php

namespace App\Livewire;

use App\Models\BasketProduct;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class Shop extends Component
{
    public $products;
    public $basketProducts;

    public $page;

    public function mount()
    {
        $this->page = page()->getPage('shop');

        $this->products = Product::with('photo')
            ->whereColumn('product_id', 'group_id')
            ->orWhereNull('group_id')
            ->where('available', true)
            ->get();

        $this->basketProducts = basket()->get();
    }

    protected function getPageIdentifier()
    {
        return 'shop';
    }

    public function redirectToProduct(Product $product)
    {
        return redirect()->route('products.show', $product);
    }

    #[On('basketUpdated')]
    public function updateBasketProducts()
    {
        $this->basketProducts = basket()->get();
    }


    public function addToBasket(Product $product)
    {
        basket()->set($product);

        $this->dispatch('basketUpdated');
    }

    public function removeFromBasket($productId)
    {
        $basketProduct = basket()->get()->where('product_id', $productId)->first();

        if($basketProduct == null)
            return false;

        basket()->remove($basketProduct);

        $this->dispatch('basketUpdated');
    }

    #[On('basketUpdated')]
    public function render()
    {
        return view('livewire.shop')
            ->layout('components.layouts.app');
    }
}
