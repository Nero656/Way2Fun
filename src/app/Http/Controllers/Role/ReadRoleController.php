<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class ReadRoleController extends Controller
{
    public function index()
    {
        return response()->json(Role::all());
    }
}
