<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
    public function __invoke(Request $request, User $user){
        return User::edit($request, $user);
    }
}
