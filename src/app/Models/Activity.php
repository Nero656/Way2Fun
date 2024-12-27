<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'price',
        'duration',
        'capacity',
    ];

    protected $hidden = [
        'guide_id',
        'city_id',
        'category_id'
    ];

    public static function activity_list($id)
    {
        return response(
            self::where('category_id', '=', $id)->get()
        );
    }

    public static function activity_list_with_pagginate($id)
    {
        return response(
            self::where('category_id', '=', $id)->simplePaginate(10)
        );
    }
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

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'activity_id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'activity_id');
    }
}
