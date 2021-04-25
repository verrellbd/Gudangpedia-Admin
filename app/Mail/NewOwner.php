<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOwner extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->id = $id;
        $this->password = $password;
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
            ->subject('New Owner Registered')
            ->markdown('mail.newowner')
            ->with([
                'name' => $this->name,
                'password' => $this->password,
                'email' => $this->email,
                'link' => 'http://127.0.0.1:8000/forgotpassword/' . $this->id
            ]);
    }
}
