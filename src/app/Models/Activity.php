<?php

namespace App\Models;

use Carbon\Carbon;
use Faker\Provider\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public mixed $review;

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'price',
        'duration',
        'capacity',
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

    public static function activity_list_with_paginate($id)
    {
        return response(
            self::where('category_id', '=', $id)->simplePaginate(10)
        );
    }

    public static function activity_list_with_paginate_search($cityName, $date){
        return response()->json(data: [
            'activity' => self::when($cityName, function ($query) use ($cityName) {
                $query->whereHas('city', function ($query) use ($cityName) {
                    $query->whereRaw("similarity(name, ?) > 0.3", [$cityName]);
                });
            })->when($date, function ($query) use ($date) {
                $query->whereHas('activity_date', function ($query) use ($date) {
                    $query->whereDate('event_date',
                        Carbon::parse($date)->tz(config('app.timezone'))->toDateString());
                });
            })
                ->with([
                    'city',
                    'guide',
                    'review.user',
                    'images',
                    'activity_date' => function ($query) use ($date) {
                        $query->where('event_date', '>=', now()->tz(config('app.timezone')))
                        ->orderByRaw('ABS(EXTRACT(EPOCH FROM (event_date - ?)))',
                            [Carbon::parse($date)->tz(config('app.timezone'))->toDateTimeString()])
                            ->limit(6);
                    }
                ])
                ->paginate(12),
        ]);
    }

    public static function make($request){
        return response(
            self::create([
                'name' => $request->name,
                'description' => $request->description,
                'short_description' => $request->short_description,
                'price' => $request->price,
                'duration' => $request->duration,
                'capacity' => $request->capacity,
                'guide_id' => $request->guide_id,
                'city_id' => $request->city_id,
                'category_id' => $request->category_id
            ])
        );
    }

    public static function edit($activity, $request)
    {
        $update = [
            'name' => $request->name ?? $activity->name,
            'description' => $request->description ?? $activity->description,
            'short_description' => $request->short_description ?? $activity->short_description,
            'price' => $request->price ?? $activity->price,
            'duration' => $request->duration ?? $activity->duration,
            'capacity' => $request->capacity ?? $activity->capacity,
            'guide_id' => $request->guide_id ?? $activity->guide_id,
            'city_id' => $request->city_id ?? $activity->city_id,
            'category_id' => $request->category_id ?? $activity->category_id
        ];

        return response([
                'message' => 'Вы обновили активность',
                'activity' => $activity,
                'updated' => $activity->update($update)
            ]
        )->setStatusCode(201);
    }

    public static function checkupActivity($activityId){
        return self::findOrFail($activityId);
    }


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id');
    }

    public function images()
    {
        return $this->hasMany(ImageUploader::class, 'activity_id');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'activity_id');
    }

    public function available_seats()
    {
        return $this->hasMany(AvailableSeat::class, 'activity_id');
    }

    public function activity_date(){
        return $this->hasMany(ActivityDate::class, 'activity_id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'activity_id');
    }
}
