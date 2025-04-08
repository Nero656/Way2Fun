<?php

namespace App\Http\Controllers\ActivityDate;

use App\Http\Controllers\Controller;
use App\Models\ActivityDate;
use Illuminate\Http\Request;

class DeleteActivityDateController extends Controller
{
    public function index(ActivityDate $activityDate){
        return $activityDate->delete();
    }
}
