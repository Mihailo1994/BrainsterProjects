<?php

namespace App\Listeners;

use App\Events\Subscribed;
use App\Mail\SendSubscriptionConfirmationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmail
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
    public function handle(Subscribed $event): void
    {
        $subscriber = $event->subscriber;
        $name = $subscriber->name;
        $email = $subscriber->email;


        Mail::to($email)->send(new SendSubscriptionConfirmationMail($name));


    }
}
