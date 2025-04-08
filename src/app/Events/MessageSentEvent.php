<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class MessageSentEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    private Message $message;
    public int $chadId;

    public function __construct(Message $message, $chatId)
    {
        $this->message = $message;
        $this->chadId = $chatId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return string[]
     */
    public function broadcastOn(): Channel
    {
        return new Channel('chat.'.$this->chadId);
    }

    public function broadcastAs() : string
    {
        return 'chat.event';
    }

    public function broadcastWith(): array
    {
        $this->message->message = Crypt::decryptString($this->message->message);
        return $this->message->load('sender')->toArray();
    }
}
