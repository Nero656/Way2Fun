<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'role_name',
        'role_level'
    ];

    public static function make($request)
    {
        return response()->json(
            self::create([
                'role_name' => $request->role_name,
                'role_level' => $request->role_level
            ])
        );
    }

    public static function edit($request, $role)
    {
        $update = [
            'role_name' => ($request->role_name !== null) ? $request->role_name : $role->role_name,
            'role_level' => ($request->role_level !== null) ? $request->role_level : $role->role_level
        ];

        return response()->json(['Вы обновили роль' => $role->update(array_merge($request->all(), $update))]);
    }
}
