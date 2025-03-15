<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class placeComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;
    public $itemId;
    public $userId;
    
    public function __construct($comment, $itemId , $userId)
    {
        $this->comment = $comment;
        $this->itemId = $itemId;
        $this->userId = $userId;
    }
    

    public function broadcastOn(): array
    {
        return [
            new Channel('comment.' . $this->itemId),
        ];
    }


    public function broadcastWith()
    {
        return [
            'comment' => $this->comment,
            'itemId' => $this->itemId,
            'userId' => $this->userId,
        ];
    }



}
