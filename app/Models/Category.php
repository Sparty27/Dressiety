<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoble');
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoble');
    }
}
