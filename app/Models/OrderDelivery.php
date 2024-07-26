<?php

namespace App\Models;

use App\Enums\DeliveryStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'ttn',
        'status',
        'warehouse_id',
    ];

    protected $casts = [
        'status' => DeliveryStatusEnum::class,
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'ref');
    }
}
