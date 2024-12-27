<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class CreateRoleController extends Controller
{
    public function index(Request $request)
    {
        return Role::make($request);
    }
}
