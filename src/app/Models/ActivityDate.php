<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityDate extends Model
{
    /** @use HasFactory<\Database\Factories\ActivityDateFactory> */
    use HasFactory;

    protected $fillable = ['activity_id', 'event_date'];

    public static function make($request){
        return response(
            self::create([
                'activity_id' => $request->activity_id,
                'event_date' => $request->event_date,
            ])
        );
    }

    public static function edit($activity, $request)
    {
        $update = [
            'activity_id' => ($request->name !== null) ? $request->activity_id : $activity->activity_id,
            'event_date' => ($request->name !== null) ? $request->event_date : $activity->event_date
        ];

        return response([
                'Вы обновили дату' => $activity->update(array_merge($request->all(), $update))
            ]
        )->setStatusCode(201);
    }
}
