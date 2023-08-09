<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserEmailEvent;
use App\Mail\UserOrderMail;
use Illuminate\Support\Facades\Mail;

class UserEmailListener
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
    public function handle(UserEmailEvent $event): void
    {
        Mail::to('juromefernando@gmail.com')->send(new UserOrderMail());
    }
}
