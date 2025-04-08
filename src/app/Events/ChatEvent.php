<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    private int $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('chat.list.'.$this->user_id),
        ];
    }

    public function broadcastAs() : string
    {
        return 'chat.list.event';
    }

    public function broadcastWith(): array
    {
        return Chat::where('user_id', $this->user_id)
            ->orWhere('guide_id', $this->user_id)
            ->with(['user', 'guide', 'latestMessage'])
            ->orderByRaw("
                COALESCE(
                    (SELECT created_at FROM messages WHERE messages.chat_id = chats.id ORDER BY created_at DESC LIMIT 1),
                    chats.created_at
                ) DESC
            ")
            ->get()->toArray();
    }
}
