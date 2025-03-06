<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BidPlaced implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bidAmount;
    public $itemId;
    public $userId;

    public function __construct($bidAmount, $itemId , $userId)
    {
        $this->bidAmount = $bidAmount;
        $this->itemId = $itemId;
        $this->userId = $userId;
    }

    public function broadcastOn(): array
    {
        return [new Channel('bids.' . $this->itemId)];
    }

    public function broadcastWith()
    {
        return [
            'bidAmount' => $this->bidAmount,
            'itemId' => $this->itemId,
            'userId' => $this->userId,
        ];
    }
}