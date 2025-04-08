<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ShowFoundActivity extends Controller
{
    public function index(Request $request){
        if ($request->city_name === null && $request->date === null) {
            return response()->json(["activity"=>['data' => []]])->setStatusCode(200);
        }

        return Activity::activity_list_with_paginate_search($request->city_name, $request->date);
    }
}
