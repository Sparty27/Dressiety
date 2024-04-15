<?php

namespace App\Services\OrderService;

use App\Enums\DeliveryStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Order;
use App\Models\OrderTransaction;
use App\Models\Warehouse;
use App\Services\MonobankService\MonobankService;
use App\Services\OrderService\Models\Customer;

class MakeOrderService
{
    public function __construct(
        protected MonobankService $monobankService,
    ) {}

    public function make(Customer $customer, Warehouse $warehouse): Order
    {
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

        $orderTransaction = $order->orderTransaction()->create(
            [
                'type' => OrderTransaction::MONOBANK,
                'sum' => $order->total,
                'status' => PaymentStatusEnum::PROCESS
            ]
        );

        dump($this->monobankService->checkout($orderTransaction));

        $order->orderDelivery()->create(
            [
                'status' => DeliveryStatusEnum::PROCESS,
                'warehouse_id' => $warehouse->ref,
            ]
        );

        return $order;
    }
}
