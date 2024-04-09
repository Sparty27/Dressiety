<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Basket extends Component
{
    #[On('basketUpdated')]
    public function render()
    {
        return view('livewire.basket');
    }
}
