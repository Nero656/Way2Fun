<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;

class ReadActivityController extends Controller
{
    public function index(){
        return Activity::all();
    }
}
