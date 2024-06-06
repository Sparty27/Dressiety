<?php

namespace App\Models;

use App\Interfaces\Seoble;
use App\Traits\SeobleTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements Seoble
{
    use HasFactory;
    use SeobleTrait;

    protected $fillable = [
        'title',
        'description'
    ];

    public function scopeSort($query, $column, $direction)
    {
        $query->orderBy($column, $direction);
    }

    public function scopeSearch($query, $search)
    {
        $query->where('title', 'like', '%'.$search.'%');
    }

//    public function scopeFilter($query, $categoryId)
//    {
//        $query->where('category_id', $categoryId);
//    }

    public function getSeoData(): array
    {
        return [
            '{title}' => $this->title,
            '{description}' => $this->description,
        ];
    }
}
