<?php

namespace App\Livewire\Admin\Products;

use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateProduct extends Component
{
    #[Validate('required')]
    public $name;

    public function render()
    {
        return view('livewire.admin.products.create-product')
            ->layout('components.layouts.admin');
    }
}
