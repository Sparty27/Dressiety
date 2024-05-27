<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Seoble
{
    public function seo(): MorphOne;
}
