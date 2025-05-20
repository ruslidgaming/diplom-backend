<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        $user = $request->validate([
            'name' => 'required|string|max:128',
            'surname' => 'required|string|max:128',
            'oldname' => 'string|max:128',
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
            'email.password' => 'Поле "Пароль" обязательно для заполения',

            'name.max' => 'Поле "Имя" не должно превышать 128 символов',
            'name.surname' => 'Поле "Фамилия" не должно превышать 128 символов',
            'name.oldname' => 'Поле "Отчество" не должно превышать 128 символов',
            'name.companyName' => 'Поле "Название компании" не должно превышать 128 символов',
            'name.companyDescription' => 'Поле "описание компании" не должно превышать 128 символов',
            'name.telephon' => 'Поле "Телефон" не должно превышать 20 символов',
            
            'email.email' => 'Поле "email" некорректно',
            'password.min' => 'Поле "Пароль" должно быть не менее 8 символов',
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

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60 // время жизни в секундах
        ]);
    }
}
