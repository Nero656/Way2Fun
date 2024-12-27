<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ReadActivityController extends Controller
{
    public function index(Activity $activity){
        return $activity;
    }
}
