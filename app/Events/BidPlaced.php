<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// class BidPlaced
// {
//     use Dispatchable, InteractsWithSockets, SerializesModels;

//     /**
//      * Create a new event instance.
//      */
//     public function __construct()
//     {
//         //
//     }

//     /**
//      * Get the channels the event should broadcast on.
//      *
//      * @return array<int, \Illuminate\Broadcasting\Channel>
//      */
//     public function broadcastOn(): array
//     {
//         return [
//             new Channel('bids'),
//         ];
//     }
// }
class BidPlaced implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bidAmount;
    public $itemId;

    public function __construct($bidAmount, $itemId)
    {
        $this->bidAmount = $bidAmount;
        $this->itemId = $itemId;
    }

    public function broadcastOn(): array
    {
        return [new Channel('bids')]; // Channel name
    }

    public function broadcastWith()
    {
        return [
            'bidAmount' => $this->bidAmount,
            'itemId' => $this->itemId,
        ];
    }
}