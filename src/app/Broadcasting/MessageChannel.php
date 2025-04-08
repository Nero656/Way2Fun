<?php

namespace App\Broadcasting;

use App\Models\Chat;
use App\Models\User;

class MessageChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user, int $chatId): array|bool
    {
        $chat = Chat::find($chatId);
        return $chat->user_id === $user->id || $chat->guide_id === $user->id;
    }
}
