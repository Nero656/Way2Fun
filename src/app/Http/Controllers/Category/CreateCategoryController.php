<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CreateCategoryController extends Controller
{
    public function index(Request $request){
        return Category::make($request);
    }
}
