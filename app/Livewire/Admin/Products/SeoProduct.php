<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\Seo;
use Livewire\Component;

class SeoProduct extends Component
{
    public $product;
    public $title;
    public $description;
    private $seo;

    public function mount(Product $product)
    {
        $this->product = $product;

        $this->seo = $seo = Seo::where('seoble_type', get_class($product))
            ->where('seoble_id', $product->id)
            ->first();

        if($seo)
        {
            $this->title = $seo->title;
            $this->description = $seo->description;
        }
    }

    public function save()
    {
        $this->product->seo()->updateOrCreate(
        [
            'seoble_id' => $this->product->id,
            'seoble_type' => get_class($this->product),
        ],
        [
            'title' => $this->title,
            'description' => $this->description,
        ]);

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.seo-product')
            ->layout('components.layouts.admin');
    }
}
