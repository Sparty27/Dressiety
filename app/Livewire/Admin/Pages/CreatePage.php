<?php

namespace App\Livewire\Admin\Pages;

use Livewire\Component;

class CreatePage extends Component
{
    public function render()
    {
        return view('livewire.admin.pages.create-page')
            ->layout('components.layouts.admin');
    }
}
