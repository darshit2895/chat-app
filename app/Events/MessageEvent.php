<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chatData;
    public $sederName;
    public $receiverName;
    /**
     * Create a new event instance.
     */
    public function __construct($chatData, $sederName, $receiverName)
    {
        $this->chatData = $chatData;
        $this->sederName = $sederName;
        $this->receiverName = $receiverName;
    }

    public function broadcastWith() {
        return ['chat' => $this->chatData, 'sederName' => $this->sederName, 'ReceiverName' => $this->receiverName];
    }

    public function broadcastAs() {
        return 'getChatMessage';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('broadcast-message'),
        ];
    }
}
