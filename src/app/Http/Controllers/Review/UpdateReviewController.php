<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class UpdateReviewController extends Controller
{
    public function index(Request $request)
    {
        return Review::edit($request);
    }
}
