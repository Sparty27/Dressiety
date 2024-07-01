<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\Gallery;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use App\Rules\GreatThanZero;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithFileUploads;

    public Gallery $gallery;

    public $product;

    public $price;

    public $categories;

    public function mount(Product $product)
    {
        $this->product = $product->toArray();

        $this->product['price'] = $product->formatted_price;

        $this->product['available'] = (boolean)$this->product['available'] ?? false;

//        dd($this->product['available']);
        $this->categories = Category::all();

        $this->gallery->setImagable($product);
    }

    public function updatedGallery()
    {
        $this->gallery->updatedUploadPhoto();
    }

    // TO DO: Перенести в Gallery
    public function renderImages($orderedIds)
    {
        $this->gallery->photos = collect($orderedIds)->map(function ($id) {
            return collect($this->gallery->photos)->where('id', $id['value'])->first();
        })->toArray();
    }

    public function deletePhoto($id)
    {
        $this->gallery->deletePhoto($id);
    }

    public function rules()
    {
        return [
            'product.name' => 'required|string|min:3|max:100',
            'product.description' => 'required|string|min:3|max:2500',
            'product.category_id' => 'required|exists:categories,category_id',
            'product.price' => 'required|numeric|min:1|max:1000000000',
            'product.count' => 'required|integer|min:0|',
            'product.available' => 'required|boolean',
        ];
    }

    public function save()
    {
        $this->product['price'] = (floatval(str_replace(' ', '', $this->product['price'])));

        $this->validate();

        $this->product['price'] = (integer)($this->product['price'] * 100);

        $model = Product::updateOrCreate([
                'id' => $this->product['id'] ?? '',
            ],
            $this->product
        );

        $this->gallery->save($model);

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.product-form')
            ->layout('components.layouts.admin');
    }
}
