<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MutipleInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $invoiceArray;

    public function __construct($invoiceArray)
    {
        $this->invoiceArray = $invoiceArray;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $invoiceArray = $this->invoiceArray;
        
        $emails = $this->view('emails.mail')->cc('account@glacanada.com');

        foreach ($invoiceArray as $invno) {

            $emails = $emails->attach("PDF/invoice/$invno/$invno.PDF");
        
        }

        
        return $emails;
    }

    
}
