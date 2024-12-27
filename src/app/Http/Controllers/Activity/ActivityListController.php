<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityListController extends Controller
{
    public function index($id){
        return Activity::activity_list($id);
    }
}
