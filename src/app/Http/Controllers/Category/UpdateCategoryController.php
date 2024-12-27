<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class UpdateCategoryController extends Controller
{
    public function index(Request $request, Category $category){
        return Category::edit($request, $category);
    }
}
