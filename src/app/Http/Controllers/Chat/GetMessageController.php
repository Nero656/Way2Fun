<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class GetMessageController extends Controller
{
    public function index($chatId)
    {
        return response()->json(Message::getMessage($chatId));
    }
}
