<?php

namespace App\Services\OrderService;

use App\Enums\DeliveryStatusEnum;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Order;
use App\Models\OrderTransaction;
use App\Models\Warehouse;
use App\Services\OrderService\Models\Customer;

class MakeOrderService
{

    public function make(Customer $customer, Warehouse $warehouse, PaymentMethodEnum $paymentMethod): Order
    {
        if(!auth()->check())
        {
            throw new \Exception("Customer is not authorized");
        }

        $order = auth()->user()->orders()->create(array_merge(
            [
                'total' => basket()->total(),
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
                'status' => DeliveryStatusEnum::PROCESS,
                'warehouse_id' => $warehouse->ref,
            ]
        );

        return $order;
    }
}
