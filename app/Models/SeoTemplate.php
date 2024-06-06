<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Array_;

class SeoTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'seoble_type',
        'title',
        'description'
    ];

    public static $templates = [
        'products',
        'pages',
    ];

}
