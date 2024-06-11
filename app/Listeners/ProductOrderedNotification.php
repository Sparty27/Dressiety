<?php

namespace App\Listeners;

use App\Events\ProductOrdered;
use App\Mail\Mailer;
use App\Mail\ProductOrderedMail;
use App\Services\SmsServices\SmsService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProductOrderedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductOrdered $event): void
    {
        $smsService = app(SmsService::class);

        $order = $event->order;

        $userName = $order->name;
        $date = Carbon::now();

        $number = $order->phone;
        $number = str_replace(['+', ' '], '', $number);

        $array = [
            '{userName}' => $userName,
            '{date}' => $date,
        ];

        Mail::to($order->email)->send(new ProductOrderedMail($order, $array));

        $smsTemplate = $smsService->getSmsTemplate('Ordered');

        $text = $smsService->replacePlaceholders($array, $smsTemplate->text);

        $smsResponse = $smsService->sendMessage($number, $text);

        Log::channel('daily')->info($smsResponse);

    }
}
