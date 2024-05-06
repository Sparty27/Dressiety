<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateCategoryForm extends Form
{
    #[Validate('required|min:5|max:100|unique:categories')]
    public $name = '';

    #[Validate('image|max:36000')]
    public $photo;
}
