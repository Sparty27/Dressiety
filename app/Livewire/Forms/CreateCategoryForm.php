<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateCategoryForm extends Form
{
    #[Validate('required|min:5|max:250')]
    public $name = '';
}
