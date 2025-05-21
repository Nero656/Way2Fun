<?php

namespace App\Http\Controllers\AvailableSeats;

use App\Http\Controllers\Controller;
use App\Models\AvailableSeat;
use Illuminate\Http\Request;

class CreateAvailableSeatController extends Controller
{
    public function index(Request $request){
        $validated = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'activity_date_id' => 'required|exists:activity_dates,id',
            'available_seats' => 'required|integer|min:0',
        ]);

        return response(AvailableSeat::create($validated));
    }
}
