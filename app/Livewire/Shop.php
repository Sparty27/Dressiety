<?php

namespace App\Livewire;

use App\Models\BasketProduct;
use App\Models\Clothing;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;

//    public $products;
    public $basketProducts;

    public $searchText;

    public $page;

    public $sizes;

    public $minPrice;
    public $maxPrice;

    public function mount()
    {
        $this->page = page()->getPage('shop');

//        $this->products = Product::with('photo')
//            ->whereColumn('product_id', 'group_id')
//            ->orWhereNull('group_id')
//            ->where('available', true)
//            ->get();

        $this->basketProducts = basket()->get();

        $this->sizes = Clothing::getSizes();
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

    public function searchQuery(Builder $builder)
    {
        $builder->search($this->searchText);
    }

    public function products()
    {
//        $builder = Product::whereColumn('product_id', 'group_id')
//            ->where('available', true)
//            ->orWhereNull('group_id')
//            ->with('firstPhoto');

//        $builder = Product::where(function ($query) {
//            $query->where('available', true);
//        })->where(function ($query) {
//            $query->whereColumn('product_id', 'group_id')
//                ->orWhereNull('group_id');
//        });

        $builder = Product::publicAvailable();

        $this->searchQuery($builder);

        return $builder->paginate(25);

    }

    #[On('basketUpdated')]
    public function render()
    {
        return view('livewire.shop', [ 'products' => $this->products()])
            ->layout('components.layouts.app');
    }
}
