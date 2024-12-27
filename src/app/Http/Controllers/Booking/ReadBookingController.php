<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReadBookingController extends Controller
{
    public function index(Booking $booking){
        return $booking;
    }
}
