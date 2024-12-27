<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'guide_id'];

    public static function getChat($userId, $guideId)
    {
        return self::firstOrCreate([
            'user_id' => $userId,
            'guide_id' => $guideId,
        ]);
    }

    public static function checkupChat($chatId){
        return self::findOrFail($chatId);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
