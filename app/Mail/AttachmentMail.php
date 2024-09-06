<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AttachmentMail extends Mailable
{
    use Queueable, SerializesModels;

    private $details;
    private $attachment;

    public function __construct($details, $attachment)
    {
        $this->details = $details;
        $this->attachment = $attachment;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->details['subject']
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.attachmentMail',
            with: [
                'details' => $this->details,
            ],
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->attachment->getRealPath())
                ->as($this->attachment->getClientOriginalName())
                ->withMime($this->attachment->getClientMimeType()),
        ];
    }
}
