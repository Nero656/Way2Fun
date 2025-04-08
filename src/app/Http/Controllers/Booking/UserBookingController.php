<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class UserBookingController extends Controller
{
    public function index(User $user)
    {
        return response()->json(Booking::where('user_id', $user->id)
            ->with('user', 'activity', 'activity.images')->get());
    }
}
