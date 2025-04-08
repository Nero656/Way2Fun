<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\BroadcastMessage;


class GetMessageController extends Controller
{
    public function index($chatId)
    {
        return response(Message::getMessage($chatId));
    }
}
