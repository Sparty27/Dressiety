<?php

namespace App\Traits;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait ImaginableTrait
{
    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'photoble');
    }

    public function photo(): MorphOne
    {
        return $this->morphOne(Photo::class, 'photoble');
    }

    public function firstPhoto()
    {
        return $this->morphOne(Photo::class, 'photoble')->orderBy('priority')->first();
    }

    public function orderPhotos()
    {
        return $this->photos()->orderBy('priority');
    }
}
