<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ReadUserController extends Controller
{
    public function index(User $user)
    {
        return response()->json($user);
    }
}
