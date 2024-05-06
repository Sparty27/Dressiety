<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $attributes = [
        'status' => false
    ];

    public function tags()
    {
        return $this->belongsToMany(Product::class);
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
