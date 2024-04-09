<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref',
        'name',
        'city_ref',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_ref', 'ref');
    }

    public function scopeSearch($query, $value)
    {
        $query->where('name', 'LIKE', $value.'%');
    }
}
