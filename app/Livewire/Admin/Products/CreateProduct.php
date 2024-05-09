<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use App\Rules\GreatThanZero;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateProduct extends Component
{
    #[Validate('required|min:3|max:100')]
    public $name = '';
    #[Validate(['required', new GreatThanZero])]
    public $price;
    #[Validate('required|min:0')]
    public $count;
    #[Validate('required')]
    public $category = '';
    public $visible;


    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function save()
    {
        $this->validate();

        $price = (integer)(floatval(str_replace(' ', '', $this->price)) * 100);

        Product::create([
            'name' => $this->name,
            'count' => $this->count,
            'price' => $price,
            'category_id' => $this->category,
            'status' => $this->visible ?? false,
        ]);

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.create-product')
            ->layout('components.layouts.admin');
    }
}
