<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'date',
        'time',
        'user_id',
        'activity_id',
        'activity_date_id'
    ];

    protected $dateFormat = 'd.m.Y';
    protected $appends = ['status'];

    public static function make($request)
    {
        $now = now();
        try {
            $bookings = collect($request->bookings);

            foreach ($bookings as $booking) {
                $seat = AvailableSeat::where('activity_id', $booking['activity_id'])
                    ->where('activity_date_id', $booking['activity_date_id'])
                    ->first();

                // Проверка доступности
                if (!$seat || $seat->available_seats < 1) {
                    return response()->json([
                        'message' => 'Недостаточно свободных мест для выбранной активности и даты.',
                        'status' => false
                    ], 400);
                }

                $seat->available_seats -= 1;
                $seat->save();
            }

            // Вставка бронирований
            $inserted = self::insert($bookings->map(function ($booking) use ($now) {
                return [
                    'date' => $booking['date'],
                    'time' => $booking['time'],
                    'user_id' => $booking['user_id'],
                    'activity_id' => $booking['activity_id'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            })->toArray());

            if ($inserted) {
                return response()->json([
                    'message' => 'Бронирования успешно созданы!',
                    'status' => true
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Не удалось создать бронирования.',
                    'status' => false
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ошибка при создании бронирований: ' . $e->getMessage(),
                'status' => false
            ], 500);
        }
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

    protected $dates = ['date'];

    public function getStatusAttribute()
    {
        return Carbon::parse($this->date)->isToday() || Carbon::parse($this->date)->isFuture();
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
