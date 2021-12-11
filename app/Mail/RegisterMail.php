<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $confirmation_code;
    private $username;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($register_email_arr)
    {
        $this->confirmation_code = $register_email_arr["confirm_code"];
        $this->username = $register_email_arr["username"];
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): RegisterMail
    {
        return $this
            ->from('register@hoster-finder.de')
            ->view('Email.Account.confirm_account')
            ->with([
                'confirm_code' => $this->confirmation_code,
                'username' => $this->username,
            ]);
    }
}
