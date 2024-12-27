<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class UpdateBookingController extends Controller
{
    public function index(Request $request, Booking $booking){
        return Booking::edit($request, $booking);
    }
}
