<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class OrderDone extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->view('mails.order_done');
    }
}
