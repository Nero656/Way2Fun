<?php

namespace App\Http\Controllers\Chat;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatListController extends Controller
{
    public function index(Request $request)
    {
        return Chat::getChatsList($request->userId);
    }
}
