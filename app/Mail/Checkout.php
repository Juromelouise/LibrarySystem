<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Checkout extends Mailable
{
    use Queueable, SerializesModels;

    public $checkoutItems; // Add a public property to store the checkout items

    /**
     * Create a new message instance.
     *
     * @param array $checkoutItems The array containing checkout items
     */
    public function __construct($checkoutItems)
    {
        $this->checkoutItems = $checkoutItems;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Checkout')
            ->view('email.checkout_email')
            ->with('checkoutItems', $this->checkoutItems);
    }
}