<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public static function categoryList(){
        return response(
            Category::with('images')->get()
        )->setStatusCode(201);
    }

    public static function make($request){
        return response(
            self::create([
                'name' => $request->name,
            ])
        )->setStatusCode(201);
    }

    public static function edit($category, $request)
    {

        $update = [
            'name' => ($request->name !== null) ? $request->name : $category->name,
        ];

        return response([
                'Вы обновили категорию' => $category->update(array_merge($request->all(), $update))
            ]
        )->setStatusCode(201);
    }

    public function images()
    {
        return $this->hasMany(ImageUploader::class, 'category_id');
    }
}
