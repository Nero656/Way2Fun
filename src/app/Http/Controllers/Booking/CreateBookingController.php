<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class CreateBookingController extends Controller
{
    public function index(Request $request){
        return Booking::make($request);
    }
}
