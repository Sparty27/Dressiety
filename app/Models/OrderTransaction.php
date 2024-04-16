<?php

namespace App\Models;

use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransaction extends Model
{
    use HasFactory;

    const MONOBANK = 'monobank';

    protected $fillable = [
        'order_id',
        'status',
        'sum',
        'type',
        'transaction_id',
    ];

    protected $casts = [
        'status' => PaymentStatusEnum::class
    ];

    public function scopeNotCompleted($query)
    {
        return $query->whereNotIn('status', [PaymentStatusEnum::FAILED, PaymentStatusEnum::SUCCESS]);
    }
}
