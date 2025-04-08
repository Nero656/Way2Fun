<?php

namespace App\Http\Controllers\User\Authorization;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        return User::registration($request);
    }
}
