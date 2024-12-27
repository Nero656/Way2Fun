<?php

namespace App\Http\Controllers\User\Authorization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index(){

        return User::logout();
    }
}
