<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
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

    public static function login($request){
        $user = $request->only('email', 'password');

        if (!$token = auth()->attempt($user)) {
            return response()->json(['error' => 'Ошибка, пароль или email не верен'], 401);
        }

        return self::respondWithToken($token);
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

    // Добавьте эти методы:
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected  static function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

}
