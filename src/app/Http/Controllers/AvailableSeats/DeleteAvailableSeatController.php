<?php

namespace App\Http\Controllers\AvailableSeats;

use App\Http\Controllers\Controller;
use App\Models\AvailableSeat;
use Illuminate\Http\Request;

class DeleteAvailableSeatController extends Controller
{
    public function index(AvailableSeat $availableSeat)
    {
        $availableSeat->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
