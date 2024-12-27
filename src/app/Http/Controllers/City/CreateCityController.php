<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CreateCityController extends Controller
{
    public function index(Request $request){
        return City::make($request);
    }
}
