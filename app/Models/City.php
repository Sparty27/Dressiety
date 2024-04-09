<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ref',
        'area_ref',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_ref', 'ref');
    }

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class, 'city_ref', 'ref');
    }

    public function scopeSearch($query, $value)
    {
        $query->where('name', 'LIKE', $value.'%');
    }
}
