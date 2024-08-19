<?php

namespace App\Livewire\Admin;

use App\Enums\MessageTypeEnum;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public function mount()
    {
        $this->dispatch('showPopup', 'Hello '.Auth::user()->name, MessageTypeEnum::INFORMATION, 2000);
    }
    public function render()
    {
        return view('livewire.admin.home')
            ->layout('components.layouts.admin');
    }
}
