<?php

namespace App\Listeners;

use App\User;
use App\Mail\SentReport;
use App\Events\UserSentReportEvent;
use App\Mail\SentReportNotification;
use Illuminate\Support\Facades\Mail;

class UserSentReportEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserSentReportEvent  $event
     * @return void
     */
    public function handle(UserSentReportEvent $event)
    {
        // Attach image to Report if existent
        if ($event->request->hasFile('image')) {
            $event->report->addMedia($event->request->file('image'))
                   ->toCollection('report-images');
        }

        // Send a confirmation E-Mail
        Mail::to($event->report->email)
            ->send(new SentReport($event->report));

        // Notify all Users
        $event->report->category->users()->each(function (User $user) use ($event) {
            Mail::to($user->email)
                    ->send(new SentReportNotification($event->report, $user));
        });
    }
}
