<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'message',
        'context',
        'created_at',
    ];

    // Optionally, cast the 'context' column to an array
    protected $casts = [
        'context' => 'array',
        'created_at' => 'datetime',
    ];
}
