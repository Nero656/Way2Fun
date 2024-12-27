<?php

namespace App\Http\Controllers\User\Authorization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrentUserController extends Controller
{
    public function index()
    {
        return auth()->user()->load('booking');
    }
}
