<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'country',
        'climate',
        'description',
        'short_description'
    ];

    public static function make($request){
       return response(
           self::create([
               'name' => $request->name,
               'country' => $request->country,
               'climate' => $request->climate,
               'description' => $request->description,
               'short_description' => $request->short_description
           ])
       )->setStatusCode(201);
    }

    public static function edit($city, $request)
    {

        $update = [
            'name' => ($request->name !== null) ? $request->name : $city->name,
            'country' => ($request->name !== null) ? $request->country : $city->country,
            'climate' => ($request->name !== null) ? $request->climate : $city->climate,
            'description' => ($request->name !== null) ? $request->description : $city->description,
            'short_description' => ($request->name !== null) ? $request->short_description : $city->short_description
        ];

        return response([
                'Вы обновили город' => $city->update(array_merge($request->all(), $update))
            ]
        )->setStatusCode(201);
    }

    public function images()
    {
        return $this->hasMany(ImageUploader::class, 'city_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'city_id');
    }
}
