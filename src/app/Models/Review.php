<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'user_id',
        'activity_id',
        'comment',
    ];

    public static function make($request){
        return response(
            self::create([
                'rating' => $request->rating,
                'user_id' => $request->user_id,
                'activity_id' => $request->activity_id,
                'comment' => $request->comment,
            ])
        )->setStatusCode(201);
    }

    public static function edit($review, $request)
    {
        $update = [
            'rating' => ($request->name !== null) ? $request->rating : $review->rating,
            'user_id' => ($request->name !== null) ? $request->user_id : $review->user_id,
            'activity_id' => ($request->name !== null) ? $request->activity_id : $review->activity_id,
            '!' => ($request->name !== null) ? $request->comment : $review->comment
        ];

        return response([
                'Вы обновили комментарий' => $review->update(array_merge($request->all(), $update))
            ]
        )->setStatusCode(201);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
