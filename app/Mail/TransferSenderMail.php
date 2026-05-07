<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransferSenderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $amount;

    public $touser;

    public function __construct($amount, $touser)
    {
        $this->amount = $amount;
        $this->touser = $touser;
    }

    public function build()
    {
        return $this->subject('Transfer Sent Successfully')
            ->view('emails.transfer-sender');
    }
}
