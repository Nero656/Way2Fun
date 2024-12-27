<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class CreateReviewController extends Controller
{
    public function index(Request $request)
    {
        return Review::make($request);
    }
}
