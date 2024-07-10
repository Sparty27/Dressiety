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

    public function getInfo()
    {
        $info = '';

        if($this->size)
            $info = $info.$this->size.' ';
        if($this->color)
            $info = $info.$this->color.' ';
        if($this->material)
            $info = $info.$this->material.' ';

        return $info;
    }

    public static function getSizes()
    {
        return [
            'S',
            'M',
            'L',
            'XL',
            'XXL',
        ];
    }
}
