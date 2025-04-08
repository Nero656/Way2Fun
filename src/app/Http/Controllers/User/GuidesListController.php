<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GuidesListController extends Controller
{
    public function index(){
        return User::guideList();
    }
}
