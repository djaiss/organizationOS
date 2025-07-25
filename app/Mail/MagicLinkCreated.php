<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MagicLinkCreated extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public string $link,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Login to ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'mail.auth.magic-link-created-text',
            markdown: 'mail.auth.magic-link-created',
            with: [
                'link' => $this->link,
            ],
        );
    }
}
