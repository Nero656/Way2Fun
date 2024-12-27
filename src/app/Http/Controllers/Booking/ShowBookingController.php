<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShowBookingController extends Controller
{
    public function index(Booking $booking)
    {
        $booking->load( 'user', 'activity');

//        return response()->json($booking);

        return response()->json(
            $booking
        );
    }
}
