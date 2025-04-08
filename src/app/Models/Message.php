<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['chat_id', 'sender_id', 'message'];

    public static function getMessage($chatId)
    {
        $messages = self::where('chat_id', $chatId)->with('sender')->get();

        // Расшифровываем сообщения при получении
        return $messages->map(function($message) {
            try {
                $message->message = Crypt::decryptString($message->message);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $message->message = '[Ошибка расшифровки]';
            }
            return $message;
        });
    }

    public static function sendMessage($request, $chatId)
    {
        return self::create([
            'chat_id' => $chatId,
            'sender_id' => $request->sender_id,
            'message' => Crypt::encryptString($request->message),
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
