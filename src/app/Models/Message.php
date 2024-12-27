<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['chat_id', 'sender_id', 'message'];

    public static function getMessage($chatId){
        return self::where('chat_id', $chatId)->get();
    }

    public static function sendMessage($request, $chatId){
        return self::create([
            'chat_id' => $chatId,
            'sender_id' => $request->sender_id,
            'message' => $request->message,
        ]);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
