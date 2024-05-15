<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use App\Rules\GreatThanZero;
use Livewire\Component;

class ProductForm extends Component
{
    public $product;

    public $price;

    public $categories;

    public function mount(Product $product)
    {
        $this->product = $product->toArray();

        $this->product['price'] = $product->formatted_price;

        $this->product['status'] = $this->product['status'] ?? false;

        $this->categories = Category::all();
    }

    public function rules()
    {
        return [
            'product.name' => 'required|string|min:3|max:100',
            'product.description' => 'required|string|min:3|max:2500',
            'product.category_id' => 'required|exists:categories,id',
            'product.price' => 'required|numeric|min:1|max:1000000000',
            'product.count' => 'required|integer|min:0|',
            'product.status' => 'required|boolean',
        ];
    }

    public function save()
    {
        $this->product['price'] = (floatval(str_replace(' ', '', $this->product['price'])));

        $this->validate();

        $this->product['price'] = (integer)($this->product['price'] * 100);

        Product::updateOrCreate([
                'id' => $this->product['id'] ?? '',
            ],
            $this->product
        );

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.product-form')
            ->layout('components.layouts.admin');
    }
}
