<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $name, $email)
    {
        //
        $this->name = $name;
        $this->email = $email;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@gudangpedia.com', 'Gudangpedia Admin')
            ->to($this->email, $this->name)
            ->subject('Reset Password User')
            ->markdown('mail.forgotpassword')
            ->with([
                'name' => $this->name,
                'link' => 'http://127.0.0.1:8000/forgotpassword/' . $this->id
            ]);
        // return $this->view('view.name');
    }
}
