<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class DeleteReviewController extends Controller
{
    public function index(Review $review){
        return $review->delete();
    }
}
