<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class ReadCityController extends Controller
{
    public function index(){
        return City::all();
    }
}
