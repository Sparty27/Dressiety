<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Home extends Component
{
    public function mount()
    {
        $this->dispatch('showPopup', 'Hello Admin', 'bg-green-500', 2000);
    }
    public function render()
    {
        return view('livewire.admin.home')
            ->layout('components.layouts.admin');
    }
}
