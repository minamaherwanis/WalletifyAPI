<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DepositMail extends Mailable
{
      use Queueable, SerializesModels;

    public $amount;
    public $user;

    public function __construct($amount, $user)
    {
        $this->amount = $amount;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Deposit Successful - Walletify')
            ->view('emails.deposit');
    }
}
