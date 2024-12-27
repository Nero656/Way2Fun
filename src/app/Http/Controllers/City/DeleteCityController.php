<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class DeleteCityController extends Controller
{
    public function index(City $city){
        return $city->delete();
    }
}
