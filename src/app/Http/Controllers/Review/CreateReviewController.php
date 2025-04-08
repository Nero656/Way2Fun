<?php

namespace App\Http\Controllers\Review;

use App\Events\CommentsEvent;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Review;
use Illuminate\Http\Request;

class CreateReviewController extends Controller
{
    public function index(Request $request)
    {
        $activity = Activity::checkupActivity($request->activity_id);

        Review::make($request);
        broadcast(new CommentsEvent($activity, $activity->id))->toOthers();

        return $activity;
    }
}
