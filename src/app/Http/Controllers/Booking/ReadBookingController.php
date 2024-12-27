<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReadBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();

        return response()->json($bookings->map(function ($booking) {
            $booking->date = Carbon::parse($booking->date)->format('m-d-Y');
            return $booking;
        }));
    }
}
