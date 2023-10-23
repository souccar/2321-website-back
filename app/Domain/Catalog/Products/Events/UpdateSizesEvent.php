<?php

namespace App\Domain\Catalog\Products\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateSizesEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sizes;
    public $productId;

    /**
     * Create a new event instance.
     */
    public function __construct($sizes,$productId)
    {
        $this->sizes = $sizes;
        $this->productId = $productId;
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
