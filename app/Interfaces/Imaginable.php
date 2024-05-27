<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Imaginable
{
    public function photos():MorphMany;
    public function photo():MorphOne;
}
