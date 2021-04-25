<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccess extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($total_price, $size, $type, $storage_name, $address, $total_unit, $email, $name)
    {
        //
        $this->total_price = $total_price;
        $this->size = $size;
        $this->type = $type;
        $this->storage_name = $storage_name;
        $this->address = $address;
        $this->total_unit = $total_unit;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@gudangpedia.com', 'Gudangpedia Admin')
            ->to($this->email)
            ->subject('Payment Successfull')
            ->markdown('mail.paymentsuccess')
            ->with([
                'total_price' => $this->total_price,
                'type' => $this->type,
                'storage_name' => $this->storage_name,
                'storage_address' => $this->address,
                'total_unit' => $this->total_unit,
                'size' => $this->size,
                'name' => $this->name
            ]);
    }
}
