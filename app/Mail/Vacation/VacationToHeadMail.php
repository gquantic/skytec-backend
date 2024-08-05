<?php

namespace App\Mail\Vacation;

use App\Models\Applications\VacationApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VacationToHeadMail extends Mailable
{
    use Queueable, SerializesModels;

    public VacationApplication $vacation;

    /**
     * Create a new message instance.
     */
    public function __construct(VacationApplication $vacation)
    {
        $this->vacation = $vacation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vacation To Head Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.vacation-to-head',
            with: [
                'vacation' => $this->vacation,
            ]
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
