<?php

namespace App\Mail;

use App\Services\EmailServices\EmailService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProductOrderedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public $subject;

    public $body;
    /**
     * Create a new message instance.
     */
    public function __construct($order, $array)
    {
        $service = app(EmailService::class);
        $this->order = $order;

        $template = $service->getEmailTemplate('Ordered');

        $this->subject = $service->replacePlaceholders($array, $template->subject);
        $this->body = $service->replacePlaceholders($array, $template->body);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.product-ordered',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
