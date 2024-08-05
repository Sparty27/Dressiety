<?php

namespace App\Services\BasketService;

use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\Product;

class BasketService
{
    public $instance;

    private function getToken()
    {
        if(isset($this->instance))
        {
            return $this->instance;
        }
        $session = session()->get('session_id');

        if (!$session) {
            session()->put('session_id', str()->uuid());
        }

        $session = session()->get('session_id');

        if(auth()->check()) {
            $this->instance = Basket::updateOrCreate(
                [
                 'user_id' => auth()->id(),
                ],
                ['user_id' => auth()->id(),
                 'session_id' => $session
                ]
            );

            $this->instance = $this->instance->load('basketProducts');

            return $this->instance;
        }

        $this->instance = Basket::firstOrCreate(
            ['session_id' => $session]
        );


        $this->instance = $this->instance->load('basketProducts', 'basketProducts.product', 'basketProducts.product.photo');

        return $this->instance;
    }

    private function clearInstance()
    {
        unset($this->instance);
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

        $basketProduct = BasketProduct::where('basket_id', $basket->id)->where('product_id', $product->id)->first();

        if($basketProduct)
            return false;

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


        $this->clearInstance();
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

        $this->clearInstance();
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

        $this->clearInstance();
    }

    public function contains(Product $product)
    {
        return $this->get()->contains('product_id', $product->id);
    }

    public function count()
    {
        return $this->get()->sum('count');
    }

    public function isEmpty()
    {
        return $this->count() == 0;
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

    public function formattedTotal()
    {
        return $this->get()->sum('total') / 100;
    }

    public function moneyTotal()
    {
        return number_format($this->formattedTotal(), 2, '.', ' ').' ₴';
    }

    public function clear()
    {
        $basketProducts = $this->get();

        foreach($basketProducts as $basketProduct)
        {
            $basketProduct->delete();
        }
    }
}
