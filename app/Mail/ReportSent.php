<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Report;
use App\Category;

class ReportSent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Report
     */
    public $report;


    /**
     * ReportSent constructor.
     *
     * @param Report $report
     *
     * @return void
     */
    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject(config('app.client') . ' ' .  config('app.name') . ' Meldung erhalten');

        return $this->markdown('emails.report-sent');
    }
}
