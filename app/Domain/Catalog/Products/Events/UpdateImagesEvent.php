<?php

namespace App\Domain\Catalog\Products\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateImagesEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $productId;
    public $images;

    /**
     * Create a new event instance.
     */
    public function __construct($images,$productId)
    {
        $this->images = $images;
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
