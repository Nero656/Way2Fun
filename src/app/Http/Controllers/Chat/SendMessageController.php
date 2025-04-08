<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageSentEvent;

class SendMessageController extends Controller
{
    public function index(Request $request, $chatId)
    {

        // Валидация входных данных
        $request->validate([
            'sender_id' => 'required|exists:users,id', // Проверка существования пользователя
            'message' => 'required|string|max:255',
        ]);

        Chat::checkupChat($chatId);

        $message = Message::sendMessage($request, $chatId);
        broadcast(new MessageSentEvent($message, $chatId))->toOthers();

        return $message;
    }
}
