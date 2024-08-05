<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'basket_id',
        'count',
    ];

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTotalAttribute()
    {
        return $this->count * $this->product->price;
    }

    public function getFormattedTotalAttribute()
    {
        return $this->count * $this->product->formatted_price;
    }

    public function getFormattedMoneyTotalAttribute()
    {
        return number_format($this->formatted_total ?? 0, 2, '.', ' ').' ₴';
    }

    public function getDescriptionAttribute()
    {
        return $this->product?->name.' '.$this->product?->clothing->info ?? '';
    }
}
