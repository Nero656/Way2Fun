<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ReadCategoryController extends Controller
{
    public function index(Category $category){
        return $category;
    }
}
