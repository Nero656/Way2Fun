<?php

namespace App\Http\Controllers\AvailableSeats;

use App\Http\Controllers\Controller;
use App\Models\AvailableSeat;
use Illuminate\Http\Request;

class ReadAvailableSeatController extends Controller
{
    public function index($activity_date_id, $activity_id){
        $seat = AvailableSeat::where('activity_id', $activity_id)
            ->where('activity_date_id', $activity_date_id)->first();

        if (!$seat) {
            return response()->json(
                ['available_seats' => 0], 200);
        }

        return response()->json($seat);
    }
}
