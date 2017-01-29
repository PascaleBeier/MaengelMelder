<?php

namespace App\Events;

use App\Http\Requests\StoreReport;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Report;
use App\Http\Requests\StoreReport as Request;

class UserSentReportEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Report
     */
    public $report;

    /**
     * @var Request
     */
    public $request;

    /**
     * Create a new event instance.
     *
     * @param Report $report
     * @param Request $request
     *
     * @return void
     */
    public function __construct(Report $report, StoreReport $request)
    {
        $this->report = $report;
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
