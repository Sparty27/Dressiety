<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;

class ShowProduct extends Component
{
    public Product $product;

    public $open = false;

    public $visible;

    public function mount()
    {
        $this->visible = (bool)$this->product->status;
    }

    public function toggleDeleteModal()
    {
        $this->open = !$this->open;
    }

    public function delete()
    {
        $this->product->delete();

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.show-product')
            ->layout('components.layouts.admin');
    }
}
