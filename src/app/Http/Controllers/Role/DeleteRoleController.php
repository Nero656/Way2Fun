<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class DeleteRoleController extends Controller
{
    public function index(Role $role){
        return $role->delete();
    }
}
