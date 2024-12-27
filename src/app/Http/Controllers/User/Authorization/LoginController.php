<?php

namespace App\Http\Controllers\User\Authorization;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request){
        return User::login($request);
    }
}
