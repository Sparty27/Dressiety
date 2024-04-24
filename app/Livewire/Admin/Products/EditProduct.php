<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;

class EditProduct extends Component
{
    public function render()
    {
        return view('livewire.admin.products.edit-product')
            ->layout('components.layouts.admin');
    }
}
