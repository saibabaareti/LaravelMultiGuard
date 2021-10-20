<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
     public $user_name;
     public $reset_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$reset)
    {

        $this->user_name=$name;
        $this->reset_code=$reset;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('emails.dashboard.user.forget_password_mail')
        ->with('user_name',$this->user_name)
        ->with('reset_code',$this->reset_code);


    }
}
