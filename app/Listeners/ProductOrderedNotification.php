<?php

namespace App\Listeners;

use App\Events\ProductOrdered;
use App\Mail\Mailer;
use App\Mail\ProductOrderedMail;
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
        Log::channel('daily')->info('Product Ordered Notification entered');
        Mail::to($event->order->email)->send(new ProductOrderedMail($event->order));
    }
}
