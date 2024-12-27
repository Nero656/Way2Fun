<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'date',
        'time',
        'user_id'
    ];

    public static function make($request){
        return response(
            self::create([
                'date' => $request->date,
                'time' => $request->time,
                'user_id' => $request->user_id,
            ])
        )->setStatusCode(201);
    }

    public static function edit($booking, $request)
    {

        $update = [
            'date' => ($request->date !== null) ? $request->date : $booking->date,
            'time' => ($request->time !== null) ? $request->time : $booking->time,
            'user_id' => ($request->user_id !== null) ? $request->user_id : $booking->user_id,
        ];

        return response([
                'Вы обновили бронь' => $booking->update(array_merge($request->all(), $update))
            ]
        )->setStatusCode(201);
    }
}
