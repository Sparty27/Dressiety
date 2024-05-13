<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'status',
        'category_id',
        'count',
        'price'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoble');
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoble');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeSort($query, $column, $direction)
    {
        $query->orderBy($column, $direction);
    }

    public function scopeSearch($query, $search)
    {
        $query->where('name', 'like', '%'.$search.'%');
    }

    public function scopeFilter($query, $categoryId)
    {
        $query->where('category_id', $categoryId);
    }

//    public function price():Attribute
//    {
//        return Attribute::make(
//            get: fn(int $value) => (float)($value / 100),
//            set: fn(float $value) => (int)($value * 100)
//        );
//    }

    public function getFormattedPriceAttribute()
    {
        return (float)($this->price / 100);
    }
}
