<?php

namespace App\Mail;

use App\Models\BusinessIdea;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BusinessIdeaMail extends Mailable
{
    use Queueable, SerializesModels;

    protected BusinessIdea $businessIdea;

    /**
     * Create a new message instance.
     */
    public function __construct(BusinessIdea $businessIdea)
    {
        $this->businessIdea = $businessIdea;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Business Idea Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.business-idea',
            with: [
                'idea' => $this->businessIdea
            ],
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
