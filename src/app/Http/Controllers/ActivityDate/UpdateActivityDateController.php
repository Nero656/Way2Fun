<?php

namespace App\Http\Controllers\ActivityDate;

use App\Http\Controllers\Controller;
use App\Models\ActivityDate;
use Illuminate\Http\Request;

class UpdateActivityDateController extends Controller
{
    public function index(Request $request){
        return ActivityDate::edit($request);
    }
}
