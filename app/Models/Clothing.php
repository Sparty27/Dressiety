<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothing extends Model
{
    use HasFactory;

    protected $fillable = [
        'size',
        'color',
        'material',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
