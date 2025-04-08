<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'guide_id'];

    public static function getChatsList($user_id){
        return self::where('user_id', '=', $user_id)
            ->orWhere('guide_id', '=', $user_id)
            ->with('user', 'guide', 'latestMessage')
            ->orderByDesc(\DB::raw("
            COALESCE(
                (SELECT created_at FROM messages WHERE messages.chat_id = chats.id ORDER BY created_at DESC LIMIT 1),
                chats.created_at
            )
        "))->get();
    }

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

    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id');
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
