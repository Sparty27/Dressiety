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
        'name'
    ];

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
