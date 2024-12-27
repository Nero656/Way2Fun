<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class UpdateActivityController extends Controller
{
    public function index(Request $request){
        return Activity::edit($request);
    }
}
