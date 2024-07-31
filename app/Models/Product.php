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

    public function sizes()
    {
        return $this->hasMany(Clothing::class, 'group_id', 'group_id');

    }

    public function availableSizes()
    {
        return $this->sizes()->whereHas('availableProduct');
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

    public function scopeAvailable($query)
    {
        $query->where('available', true);
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

    public function scopeBySizes($query, $shopSizes)
    {
        $query->whereHas('clothing', function($query) use ($shopSizes) {
            $query->whereIn('size', $shopSizes);
        });
    }

    public function scopeByColors($query, $shopColors)
    {
        $query->whereHas('clothing', function($query) use ($shopColors) {
            $query->whereIn('color', $shopColors);
        });
    }

    public function scopePriceBetween($query, int $min, int $max)
    {
        $query->whereBetween('price', [$min, $max]);
    }

    public function getFormattedPriceAttribute()
    {
        return (float)($this->price / 100);
    }

    public function getMoneyPriceAttribute()
    {
        return number_format($this->formatted_price, 2, '.', ' ');
    }

    public function getFullTitleAttribute()
    {
        return $this->name.' '.$this->clothing->size;
    }

    public function getSeoData(): array
    {
        return [
            '{title}' => $this->name,
            '{description}' => $this->description,
            '{categoryName}' => $this->category->name
        ];
    }
}
