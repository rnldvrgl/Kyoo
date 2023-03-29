<?php

namespace App\Events;

use App\Models\QueueTicket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewTicketEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $queueTicket;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $tickets = QueueTicket::where('status', "Pending")->orderBy('created_at', 'asc')->get();
        $this->queueTicket = $tickets;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public.new-pending-ticket');
    }

    public function broadcastAs()
    {
        return "new-pending-ticket";
    }
}
