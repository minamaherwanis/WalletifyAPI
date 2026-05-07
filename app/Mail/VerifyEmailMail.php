<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class VerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $link;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->link = url('/api/verify-email?token=' . $user->email_verification_token);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Your Email - VaultPay',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verify-email',
            with: [
                'user' => $this->user,
                'link' => $this->link,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}