<?php

namespace App\Http\Controllers\ActivityDate;

use App\Http\Controllers\Controller;
use App\Models\ActivityDate;
use Illuminate\Http\Request;

class ReadActivityDateController extends Controller
{
    public function index(){
        return ActivityDate::all();
    }
}
