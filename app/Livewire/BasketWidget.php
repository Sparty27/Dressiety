<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class BasketWidget extends Component
{
    #[On('basketUpdated')]
    public function render()
    {
        return view('livewire.basket-widget');
    }
}
