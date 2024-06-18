<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'uuid',
        'user_id',
        'total',
        'email',
        'name',
        'phone',
    ];

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function orderTransaction()
    {
        return $this->hasOne(OrderTransaction::class);
    }

    public function orderDelivery()
    {
        return $this->hasOne(OrderDelivery::class);
    }

    public function formattedTotal()
    {
        return (float)($this->total / 100);
    }

    public function getFormattedPhoneAttribute()
    {
        return str_replace(['+', ' '], '', $this->phone);
    }
}
