<?php

namespace App\Listeners;

use App\Events\ProductOrdered;
use App\Services\SmsServices\SmsService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductOrderedSmsNotification
{
    private SmsService $smsService;

    /**
     * Create the event listener.
     */
    public function __construct(SmsService $service)
    {
        $this->smsService = $service;
    }

    /**
     * Handle the event.
     */
    public function handle(ProductOrdered $event): void
    {
        $order = $event->order;

        $userName = $order->name;
        $date = Carbon::now();

        $phone = $order->formatted_phone;

        $array = [
            '{userName}' => $userName,
            '{date}' => $date,
        ];

        $this->smsService->sendMessage($phone, 'Ordered', $array);
    }
}
