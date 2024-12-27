<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class UpdateCityController extends Controller
{
    public function index(Request $request, City $city){
        return City::edit($request, $city);
    }
}
