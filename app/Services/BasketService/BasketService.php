<?php

namespace App\Services\BasketService;

use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\Product;

class BasketService
{

    private function getToken()
    {
        $session = session()->get('session_id');

        if (!$session) {
            session()->put('session_id', str()->uuid());
        }

        $session = session()->get('session_id');

        if(auth()->check()) {
            return Basket::updateOrCreate(
                ['session_id' => $session],
                ['user_id' => auth()->id()]
            );
        }

        return Basket::firstOrCreate(
            ['session_id' => $session]
        );
    }

    public function get()
    {
        $basket = $this->getToken();

        return $basket->basketProducts;
    }

    public function set(Product $product, int $count = 1)
    {

        $basket = $this->getToken();

        if($product->count < $count || $count < 0)
        {
            return false;
        }

        $basketProduct = BasketProduct::updateOrCreate(
            [
                'product_id' => $product->id,
                'basket_id' => $basket->id,
            ],
            [
                'count' => $count,
            ]
        );

        $product->decrement('count', $count);

        return $basketProduct;
    }

    public function update(BasketProduct $basketProduct, int $count)
    {
        $newCount = $basketProduct->count + $count;
        $product = $basketProduct->product;

        if($newCount < 0 || $count > $product->count)
        {
            return false;
        }

        if($newCount == 0)
        {
            $this->remove($basketProduct);
            return true;
        }

        $basketProduct->update([
            'count' => $newCount,
        ]);

        $product->update([
            'count' => $product->count - $count,
        ]);

        return $basketProduct;
    }

    public function remove(BasketProduct $basketProduct)
    {
        $product = $basketProduct->product;
        $basketCount = $basketProduct->count;

        $product->update([
            'count' => $product->count + $basketCount,
        ]);

        $basketProduct->delete();
    }

    public function count()
    {
        return $this->get()->sum('count');
    }

    public function increment(BasketProduct $basketProduct)
    {
        $this->update($basketProduct, 1);
    }

    public function decrement(BasketProduct $basketProduct)
    {
        $this->update($basketProduct, -1);
    }

    public function total()
    {
        return $this->get()->sum('total');
    }
}
