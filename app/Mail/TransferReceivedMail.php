<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransferReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $amount;
    public $fromUser;

    public function __construct($amount, $fromUser)
    {
        $this->amount = $amount;
        $this->fromUser = $fromUser;
    }

    public function build()
    {
        return $this->subject('Transfer Received Successfully')
            ->view('emails.transfer-received');
    }
}
