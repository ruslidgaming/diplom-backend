<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use DB;
use Illuminate\Http\Request;
use Str;

class MentorController extends Controller
{
    public function login(Request $request)
    {
        
        $credentials = $request->only('login', 'password');

        if (!$token = auth('mentor-api')->attempt($credentials)) {
            return response()->json(['error' => 'Неверный email или пароль'], 401);
        }

        // Генерация refresh token
        // $refreshToken = Str::random(128);
        // $expiresAt = now()->addDays(7); // Срок жизни refresh token

        // Сохраняем refresh token в БД
        // DB::table('refresh_tokens')->insert([
        //     'token' => $refreshToken,
        //     'admin_id' => auth('admin-api')->id(),
        //     'expires_at' => $expiresAt,
        // ]);
        $user = auth('mentor-api')->user();
        $user->role = 'mentor';

        return response()->json([
            'access_token' => $token,
            // 'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 120,
            'user' => $user,
        ]);
    }

    public function create(Request $request) {
        $val = $request->validate([
            'name' => 'required|string|max:64',
            'surname' => 'required|string|max:64',
            'login' => 'required|string|max:64',
            'password' => 'required|min:8'
        ],[
            'name.required' => 'Поле "имя" обязательно',
            'surname.required' => 'Поле "фамилия" обязательно',
            'login.required' => 'Поле "логин" обязательно',
            'password.required' => 'Поле "пароль" обязательно',

            'name.max' => 'Поле "имя" не может превышать 64 символа',
            'surname.max' => 'Поле "имя" не может превышать 64 символа',
            'login.max' => 'Поле "имя" не может превышать 64 символа',
            'password.min' => 'Минимальный пароль 8 символов',
        ]);

        $user = Mentor::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'login' => $request->login,
            'password' => $request->password,
            'admin_id' => $request->id,
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function update(Request $request){
        $val = $request->validate([
            'name' => 'required|string|max:64',
            'surname' => 'required|string|max:64',
            'login' => 'required|string|max:64',
            'password' => 'required|min:8'
        ],[
            'name.required' => 'Поле "имя" обязательно',
            'surname.required' => 'Поле "фамилия" обязательно',
            'login.required' => 'Поле "логин" обязательно',
            'password.required' => 'Поле "пароль" обязательно',

            'name.max' => 'Поле "имя" не может превышать 64 символа',
            'surname.max' => 'Поле "имя" не может превышать 64 символа',
            'login.max' => 'Поле "имя" не может превышать 64 символа',
            'password.min' => 'Минимальный пароль 8 символов',
        ]);

        Mentor::where('id', $request->id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'login' => $request->login,
            'password' => $request->password,
        ]);
        $user = Mentor::where('id', $request->id)->first();

        return response()->json(['user' => $user], 201);
    }

    public function logout() {
        auth('mentor-api')->logout();

        return response()->json(true, 201);
    }

    public function catalog() {
        $id = auth('admin-api')->id();

        $mentors = Mentor::where('admin_id', $id)->get();

        return response()->json($mentors, 201);
    }
}
