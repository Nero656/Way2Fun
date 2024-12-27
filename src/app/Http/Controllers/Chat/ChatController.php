<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($userId, $guideId)
    {
        return response()->json(Chat::getChat($userId, $guideId));
    }
}
