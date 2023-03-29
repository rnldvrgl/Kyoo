<?php

namespace App\Events;

use App\Models\QueueTicket;
use App\Models\QueueTicketService;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PendingTicketsEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $queueTicket;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($queueTicket)
    {
        $this->queueTicket = $queueTicket;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public.pending-tickets');
    }

    public function broadcastAs()
    {
        return "pending-tickets-to-dashboard";
    }
}
