<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'products',
    ];

    public static function makeOrUpdate($request)
    {
        $cart = self::where('user_id', $request->user_id)->first();

        if ($cart) {
            // Если запись существует, обновляем её
            $cart->update([
                'products' => $request->products ?? $cart->products,
            ]);

            return response([
                'message' => 'Корзина обновлена',
                'cart' => $cart
            ])->setStatusCode(200);
        } else {
            // Если записи нет, создаем новую
            $cart = self::create([
                'user_id' => $request->user_id,
                'products' => $request->products,
            ]);

            return response([
                'message' => 'Корзина создана',
                'cart' => $cart
            ])->setStatusCode(201);
        }
    }
}
