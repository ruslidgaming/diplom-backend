<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use DB;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Str;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        $user = $request->validate([
            'name' => 'required|string|max:128',
            'surname' => 'required|string|max:128',
            'oldname' => 'nullable|string|max:128',
            'companyName' => 'required|string|max:128',
            'companyDescription' => 'required|string|max:1024',
            'telephon' => 'required|string|max:20',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',
            'password_r' => 'required|same:password'
        ], 

        [
            'name.required' => 'Поле "Имя" обязательно для заполения',
            'surname.required' => 'Поле "Фамилия" обязательно для заполения',
            'companyName.required' => 'Поле "Название компании" обязательно для заполения',
            'companyDescription.required' => 'Поле "Описание компании" обязательно для заполения',
            'telephon.required' => 'Поле "Телефон" обязательно для заполения',
            'email.required' => 'Поле "Email" обязательно для заполения',
            'password.required' => 'Поле "Пароль" обязательно для заполения',
            'password_r.required' => 'Поле "Подтвердите пароль" обязательно для заполения',
            'email.unique' => 'Такой email уже используется',

            'name.max' => 'Поле "Имя" не должно превышать 128 символов',
            'surname.max' => 'Поле "Фамилия" не должно превышать 128 символов',
            'oldname.max' => 'Поле "Отчество" не должно превышать 128 символов',
            'companyName.max' => 'Поле "Название компании" не должно превышать 128 символов',
            'companyDescription.max' => 'Поле "описание компании" не должно превышать 128 символов',
            'telephon.max' => 'Поле "Телефон" не должно превышать 20 символов',
            
            'email.email' => 'Поле "email" некорректно',
            'password.min' => 'Поле "Пароль" должно быть не менее 8 символов',
            'password_r.same' => 'Пароли не совпадают'
        ]
    
    );
        

        $user = Admin::create($user);

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request)
    {
        
        $credentials = $request->only('email', 'password');

        if (!$token = auth('admin-api')->attempt($credentials)) {
            return response()->json(['error' => 'Неверный email или пароль'], 401);
        }

        // Генерация refresh token
        $refreshToken = Str::random(128);
        $expiresAt = now()->addDays(7); // Срок жизни refresh token

        // Сохраняем refresh token в БД
        DB::table('refresh_tokens')->insert([
            'token' => $refreshToken,
            'admin_id' => auth('admin-api')->id(),
            'expires_at' => $expiresAt,
        ]);
        $user = auth('admin-api')->user();
        array_push($user, 'admin');

        return response()->json([
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60,
            'user' => auth('admin-api')->user(),
        ]);
    }

    public function refresh(Request $request)
{
    $refreshToken = $request->input('refresh_token');

    // Проверяем refresh token в БД
    $tokenRecord = DB::table('refresh_tokens')
        ->where('token', $refreshToken)
        ->where('expires_at', '>', now())
        ->first();

    if (!$tokenRecord) {
        return response()->json(['error' => 'Недействительный refresh token'], 401);
    }

    // Авторизуем администратора
    $admin = Admin::find($tokenRecord->admin_id);
    $newAccessToken = auth('admin-api')->fromUser($admin);

    // Удаляем использованный refresh token
    DB::table('refresh_tokens')->where('token', $refreshToken)->delete();

    // Генерируем новый refresh token
    $newRefreshToken = Str::random(128);
    DB::table('refresh_tokens')->insert([
        'token' => $newRefreshToken,
        'admin_id' => $admin->id,
        'expires_at' => now()->addDays(7),
    ]);

    return response()->json([
        'access_token' => $newAccessToken,
        'refresh_token' => $newRefreshToken,
        'token_type' => 'bearer',
        'expires_in' => config('jwt.ttl') * 60,
        'role' => 'admin',
    ]);
}
public function getAdmin(Request $request) {
    $token = $request;

    $user = JWTAuth::setToken($token)->authenticate();

    return response()->json(['user' => $user], 201);
}
}
