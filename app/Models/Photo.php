<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    const IMAGE_NOT_FOUND = 'https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=';

    protected $fillable = [
        'url',
    ];

    public function getUrl()
    {
        if($this->url == null || asset($this->url) == asset(''))
        {
            return $this::IMAGE_NOT_FOUND;
        }

        return asset($this->url);
    }

    public function photoble()
    {
        return $this->morphTo();
    }
}
