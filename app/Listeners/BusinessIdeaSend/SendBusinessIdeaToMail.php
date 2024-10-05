<?php

namespace App\Listeners\BusinessIdeaSend;

use App\Events\BusinessIdeaSend;
use App\Mail\BusinessIdeaMail;
use App\Services\MailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBusinessIdeaToMail
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
    public function handle(BusinessIdeaSend $event): void
    {
        Mail::to(
            MailService::getMailAddresses('business_idea')
        )->send(new BusinessIdeaMail($event->businessIdea));
    }
}
