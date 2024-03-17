<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'ref',
        'name',
        'area_center_ref'
    ];

    public function product()
    {
        return $this->hasMany(City::class);
    }
}
