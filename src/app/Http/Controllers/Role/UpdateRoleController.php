<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class UpdateRoleController extends Controller
{
    public function index(Request $request, Role $role)
    {
        return Role::edit($request, $role);
    }
}
