<?php

namespace App\Listeners;

use App\Events\NewOffer;
use App\Mail\SendMailToSubscribers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationEmail
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
    public function handle(NewOffer $event): void
    {
        $subscribers = $event->subscribers;
        foreach($subscribers as $subscriber){
            Mail::to($subscriber->email)->send(new SendMailToSubscribers($subscriber->name));
        }
    }
}
