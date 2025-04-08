<?php

namespace App\Http\Controllers\User\Authorization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrentUserController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Ошибка авторизации'], 401);
        }

        return response()->json($user->load('booking', 'role'));
    }
}
