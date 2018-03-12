<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $invno;

    public function __construct($invno)
    {
        $this->invno = $invno;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $invno = $this->invno;
        
        return $this->view('emails.mail')
                    ->cc('account@glacanada.com')
                    ->attach("PDF/invoice/$invno/$invno.PDF");
    }
}
