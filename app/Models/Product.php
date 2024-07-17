<?php

namespace App\Models;

use App\Interfaces\Imaginable;
use App\Interfaces\Seoble;
use App\Traits\ImaginableTrait;
use App\Traits\SeobleTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Imaginable, Seoble
{
    use HasFactory;
    use ImaginableTrait;
    use SeobleTrait;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'status',
        'category_id',
        'count',
        'price',
        'vendor_code',
        'currency',
        'product_id',
        'group_id',
        'available'
    ];

    public function clothing()
    {
        return $this->hasOne(Clothing::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
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
        $category = Category::where('category_id', $categoryId)->first();

        if ($category) {
            $subcategoryIds = $category->getAllSubcategoryIds();

            $allCategoryIds = array_merge([$categoryId], $subcategoryIds);

            $query->whereIn('category_id', $allCategoryIds);
        } else {
            $query->where('category_id', $categoryId);
        }
    }

    public function availableSizes()
    {
        $sizes = Clothing::whereHas('product', function($query) {
            $query->where('group_id', $this->group_id)
                ->where('available', true);
        })->get()->map(function ($clothing) {
            return [
                'product_id' => $clothing->product_id,
                'size' => $clothing->size,
            ];
        });

        return $sizes;
    }

    public function scopePublicAvailable($query)
    {
        $query->where(function ($query) {
            $query->where('available', true);
        })->where(function ($query) {
            $query->whereColumn('product_id', 'group_id')
                ->orWhereNull('group_id');
        });
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

    public function getSeoData(): array
    {
        return [
            '{title}' => $this->name,
            '{description}' => $this->description,
            '{categoryName}' => $this->category->name
        ];
    }

//    public function getInfo()
//    {
//        $info = $this->name;
//
//        if($this->clothing->size)
//            $info = $info.' '.$this->clothing->size;
//        if($this->clothing->color)
//            $info = $info.' '.$this->clothing->color;
//
//        return $info;
//    }
}
