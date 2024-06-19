<?php

namespace App\Models;

use App\Enums\EmailTemplateEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject',
        'body',
    ];

    protected $casts = [
        'name' => EmailTemplateEnum::class
    ];
}
