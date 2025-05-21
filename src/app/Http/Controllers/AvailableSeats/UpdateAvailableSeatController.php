<?php

namespace App\Http\Controllers\AvailableSeats;

use App\Http\Controllers\Controller;
use App\Models\AvailableSeat;
use Illuminate\Http\Request;

class UpdateAvailableSeatController extends Controller
{
    public function index(Request $request, $id){
        $seat = AvailableSeat::findOrFail($id);

        $validated = $request->validate([
            'users_count' => 'required|integer|min:1',
        ]);

        $usersCount = $validated['users_count'];


        // Проверка: достаточно ли свободных мест
        if ($seat->available_seats < $usersCount) {
            return response()->json([
                'message' => 'Недостаточно свободных мест.'
            ], 400);
        }

        // Обновление количества свободных мест
        $seat->available_seats -= $usersCount;
        $seat->save();

        return response()->json($seat);
    }
}
