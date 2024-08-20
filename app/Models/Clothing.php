<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothing extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'size',
        'color',
        'material',
    ];

    const COLORS = [
        'Чорний' => 'чорн',
        'Білий' => 'біл',
    ];

    const SIZES = [
        'S',
        'M',
        'L',
        'XL',
        'XXL',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function availableProduct()
    {
        return $this->product()->available();
    }

    public function getInfoAttribute()
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
}
