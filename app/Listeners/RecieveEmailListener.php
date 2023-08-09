<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ReciveEmailEvent;
use App\Mail\Checkout;
use Illuminate\Support\Facades\Mail;

class RecieveEmailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReciveEmailEvent $event): void
    {
        Mail::to('juromefernando@gmail.com')->send(new Checkout($event->borrow));
    }
}