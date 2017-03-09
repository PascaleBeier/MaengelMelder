<?php

namespace App\Listeners;

use App\User;
use App\Image;
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
     * @param  Image  $image
     * @return void
     */
    public function handle(UserSentReportEvent $event)
    {
        // Attach image to Report if existent
        if ($event->request->hasFile('image')) {
            $file = $event->request->file('image');
            $path = uniqid('img');
            $file->move(config('filesystems.disks.images.root'), $path.'.jpg');
            $image = new Image();
            $image->name = $path;
            $image->save();
            $event->report->image()->associate($image);
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
