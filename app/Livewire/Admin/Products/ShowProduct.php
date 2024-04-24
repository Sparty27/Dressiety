<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;

class ShowProduct extends Component
{
    public function render()
    {
        return view('livewire.admin.products.show-product')
            ->layout('components.layouts.admin');
    }
}
