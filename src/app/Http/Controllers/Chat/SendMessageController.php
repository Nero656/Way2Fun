<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class SendMessageController extends Controller
{
    public function index(Request $request, $chatId)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id', // Проверка отправителя
            'message' => 'required|string|max:255',
        ]);

        Chat::checkupChat($chatId);

        return response()->json(Message::sendMessage($request, $chatId));
    }
}
