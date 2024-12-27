<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class DeleteActivityController extends Controller
{
    public function index(Activity $activity){
        return $activity->delete();
    }
}
