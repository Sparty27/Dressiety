<?php

namespace App\Listeners;

use App\Enums\EmailTemplateEnum;
use App\Events\ProductOrdered;
use App\Mail\ProductOrderedMail;
use App\Services\EmailServices\EmailService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProductOrderedEmailNotification
{
    private EmailService $emailService;
    /**
     * Create the event listener.
     */
    public function __construct(EmailService $service)
    {
        $this->emailService = $service;
    }

    /**
     * Handle the event.
     */
    public function handle(ProductOrdered $event): void
    {
        $order = $event->order;

        $userName = $order->name;
        $date = Carbon::now();

        $arrayData = [
            '{userName}' => $userName,
            '{date}' => $date,
        ];

        $emailData = $this->emailService->getEmailData(EmailTemplateEnum::ORDERED, $arrayData);

        try {
            Mail::to($order->email)->send(new ProductOrderedMail($order, $emailData['subject'], $emailData['body']));
        } catch(\Exception $ex) {
            Log::warning($ex->getMessage(), [$order]);
        }
    }
}
