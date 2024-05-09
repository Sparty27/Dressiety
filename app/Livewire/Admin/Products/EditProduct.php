<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use App\Rules\GreatThanZero;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditProduct extends Component
{
    public Product $product;


    #[Validate('required|min:3|max:100')]
    public $name = '';
    public $price = 0;
    public $count;
    public $visible;

    #[Validate('required')]
    public $category;

    public $categories;

    public function mount()
    {
        $this->name = $this->product->name;
        $this->price = (float)($this->product->price / 100);
        $this->count = $this->product->count;
        $this->visible = (bool)$this->product->status;

        $this->category = $this->product->category->id;

        $this->categories = Category::all();
    }

    public function resetForm()
    {
        $this->name = $this->product->name;
        $this->price = (float)($this->product->price / 100);
        $this->count = $this->product->count;
        $this->visible = $this->product->status;
        $this->category = $this->product->category->id;
    }

    public function save()
    {
        $price = (integer)(floatval(str_replace(' ', '', $this->price)) * 100);

        if ($price <= 0) {
            return $this->addError('price', 'Ціна повинна бути більше нуля.');
        }

        $this->validate();

        $this->product->update([
            'name' => $this->name,
            'price' => $price,
            'count' => $this->count,
            'category_id' => $this->category,
            'status' => $this->visible ?? false,
        ]);

        return redirect()->route('admin.products.show', $this->product);
    }

    public function render()
    {
        return view('livewire.admin.products.edit-product')
            ->layout('components.layouts.admin');
    }
}
