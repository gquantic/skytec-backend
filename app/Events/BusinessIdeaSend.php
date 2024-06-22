<?php

namespace App\Events;

use App\Models\BusinessIdea;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BusinessIdeaSend
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public BusinessIdea $businessIdea;

    /**
     * Create a new event instance.
     */
    public function __construct(BusinessIdea $businessIdea)
    {
        $this->businessIdea = $businessIdea;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
