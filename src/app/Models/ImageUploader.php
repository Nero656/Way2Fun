<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;


class ImageUploader extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_url',
        'category_id',
        'city_id',
        'activity_id'
    ];

    protected $table = 'images';


    public static function make($request){
        $validated = $request->validate([
            'file' => 'required|file|mimes:jpeg,jpg,png,gif,webp',
            'category_id' => 'nullable|integer|exists:categories,id', // Если передано, проверим, существует ли категория
            'city_id' => 'nullable|integer|exists:cities,id', // Если передано, проверим, существует ли город
            'activity_id' => 'nullable|integer|exists:activities,id', // Если передано, проверим, существует ли активность
        ]);

        return response(
            self::create([
                'img_url' => self::image_url($request->file, 2560, 1024),
                'category_id' => $request->category_id ?? null,
                'city_id' => $request->city_id ?? null,
                'activity_id' => $request->activity_id ?? null,
            ])
        )->setStatusCode(201);
    }

    //    public static function image_url_no_resize($file)
//    {
//        $fileName = uniqid();
//
//        $image = ImageManagerStatic::make($file)
//            ->save(storage_path('app/public/images' . $fileName . '.webp'), 100, 'webp');
//
//        $fileDir = 'public/';
//
//        return Storage::url($fileDir . $image->basename);
//    }

    public static function image_url($file, $wight, $height)
    {
        $fileName = uniqid();
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->scale($wight, $height);
        $imagePath = $fileName . '.webp';
        $image->save(storage_path('app/public/' . $fileName . '.webp'), 100, 'webp');
        return Storage::url($imagePath);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
