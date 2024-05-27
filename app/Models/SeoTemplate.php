<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'seoble_type',
        'title',
        'description'
    ];
}
