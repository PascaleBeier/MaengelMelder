<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Report;

class SentReportNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Report $report;
     */
    public $report;

    /**
     * @var User $user;
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param Report $report
     * @param User $user
     *
     * @return void
     */
    public function __construct(Report $report, User $user)
    {
        $this->report = $report;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $attachment = $this->report->getMedia()[0]->getPath();
        $subject = config('app.client') . ' - ' .  config('app.name') .  ': Meldung erhalten';

        return $this->markdown('emails.sent-report-notification')
            ->attach($attachment)
            ->subject($subject);
    }
}
