<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ShowActivityController extends Controller
{
    public function index(Activity $activity){
        $activity->load('city','guide', 'review');

        $average_rating = $activity->review()->avg('rating');

        $count_review = $activity->review()->count();

        $count_activities = $activity->booking()->count();

        return response()->json([
            'activity' => $activity,
            'average rating' =>  $average_rating,
            'count review' => $count_review,
            'count activities booking' => $count_activities
        ]);
    }
}
