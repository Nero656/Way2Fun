<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'telephone',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function registration($request){
        return response(
            self::create([
                "name" => $request->name,
                "email" => $request->email,
                "telephone" => $request->telephone,
                "password" => $request->password,
                "role_id" => $request->role_id = 2
            ])
        )->setStatusCode(201);
    }

    public function login($request){
        $user = $request(['email', 'password']);

        if (!$token = auth()->attempt($user)) {
            return response()->json(['error' => 'Ошибка, пароль или email не верен'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public static function edit($request, $role)
    {
        $update = [
            "name" => ($request->name !== null) ? $request->name : $role->name,
            "email" => ($request->email !== null) ? $request->email : $role->email,
            "telephone" => ($request->telephone !== null) ? $request->telephone : $role->telephone,
            "password" => ($request->password !== null) ? $request->password : $role->password,
            "role_id" => ($request->role_id !== null) ? $request->role_id : $role->role_id,
        ];

        return response()->json(['Вы обновили роль' => $role->update(array_merge($request->all(), $update))]);
    }

    public function logout(){
        Auth::user()->logout();

        return response()->json(['response' => "Вы успешно вышли из системы"]);
    }
}
