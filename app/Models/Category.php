<?php

namespace App\Models;

use App\Traits\ImaginableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements \App\Interfaces\Imaginable
{
    use HasFactory;
    use ImaginableTrait;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'category_id',
        'parent_id',
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id','category_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id','category_id');
    }

    public function getAllSubcategoryIds()
    {
        $ids = $this->children()->pluck('category_id')->toArray();

        foreach ($this->children as $child) {
            $ids = array_merge($ids, $child->getAllSubcategoryIds());
        }

        return $ids;
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeSearch($query, $search)
    {
        $query->where('name', 'like', '%'.$search.'%');
    }

    public function scopeSort($query, $column, $direction)
    {
        $query->orderBy($column, $direction);
    }
}
