<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    #[Validate('required|min:3|max:100')]
    public $name = '';

    #[Validate('image|max:36000')]
    public $photo;
}
