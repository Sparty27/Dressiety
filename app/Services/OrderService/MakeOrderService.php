<?php

namespace App\Services\OrderService;

use App\Enums\DeliveryStatusEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Events\ProductOrdered;
use App\Models\Order;
use App\Models\OrderTransaction;
use App\Models\Warehouse;
use App\Services\OrderService\Models\Customer;
use Illuminate\Support\Facades\Log;

class MakeOrderService
{

    public function make(Customer $customer, Warehouse $warehouse, PaymentMethodEnum $paymentMethod): Order
    {
        $order = Order::create(array_merge(
            [
                'user_id' => auth()->id(),
                'total' => basket()->total(),
                'status' => OrderStatusEnum::NEW,
            ],
            $customer->toArray()
        ));


        foreach (basket()->get() as $basketProduct)
        {
            $order->orderProducts()->create([
                'product_id' => $basketProduct->product_id,
                'name' => $basketProduct->product->name,
                'count' => $basketProduct->count,
                'price' => $basketProduct->product->price,
                'sum' => $basketProduct->total
            ]);
        }

        $order->orderTransaction()->create(
            [
                'type' => $paymentMethod,
                'sum' => $order->total,
                'status' => PaymentStatusEnum::PROCESS,
            ]
        );

        $order->orderDelivery()->create(
            [
                'status' => DeliveryStatusEnum::NOT_SENT,
                'warehouse_id' => $warehouse->ref,
            ]
        );

        Log::channel('daily')->info('ProductOrdered event called');
        ProductOrdered::dispatch($order);

        return $order;
    }
}
