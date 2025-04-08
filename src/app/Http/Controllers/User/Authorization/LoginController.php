<?php

namespace App\Http\Controllers\User\Authorization;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return User::login($request);
    }
}
