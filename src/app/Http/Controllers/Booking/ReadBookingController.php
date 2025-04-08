<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;

class ReadBookingController extends Controller
{
    public function index()
    {
        return response()->json(Booking::all()->load( 'user', 'activity'));
    }
}
