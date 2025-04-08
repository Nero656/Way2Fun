<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;

class ActivityListController extends Controller
{
    public function index($id){
        $activityList = Activity::where('category_id', '=', $id)->paginate(10);

        $activityList->load([
            'city',
            'guide',
            'images' => function ($query) {
                $query->orderBy('activity_id');
            },
            'activity_date' => function ($query) {
                $query->where('event_date', '>=', now())
                    ->orderBy('event_date')->limit(6);
            }
        ]);

        return response()->json(
            $activityList
        );
    }

    public function cityList($id){
        $activityList = Activity::where('city_id', '=', $id)->paginate(10);

        $activityList->load([
            'city',
            'guide',
            'images' => function ($query) {
                $query->orderBy('activity_id');
            },
            'activity_date' => function ($query) {
                $query->where('event_date', '>=', now())
                    ->orderBy('event_date')->limit(6);
            }
        ]);

        return response()->json(
            $activityList
        );
    }

    public function show($id){
        return response()->json(Activity::where('category_id', '=', $id)->get());
    }
}
