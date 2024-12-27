<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'description',
        'short_description',
        'price',
        'duration',
        'capacity',
    ];
    public static function make($request){
        return response(
            self::create([
                'name' => $request->name,
                'description' => $request->description,
                'short_description' => $request->short_description,
                'price' => $request->price,
                'duration' => $request->duration,
                'capacity' => $request->capacity
            ])
        );
    }

    public static function edit($activity, $request)
    {
        $update = [
            'name' => ($request->name !== null) ? $request->name : $activity->name,
            'country' => ($request->name !== null) ? $request->country : $activity->country,
            'climate' => ($request->name !== null) ? $request->climate : $activity->climate,
            'description' => ($request->name !== null) ? $request->description : $activity->description,
            'short_description' => ($request->name !== null) ? $request->short_description : $activity->short_description
        ];

        return response([
                'Вы обновили город' => $activity->update(array_merge($request->all(), $update))
            ]
        )->setStatusCode(201);
    }
}
