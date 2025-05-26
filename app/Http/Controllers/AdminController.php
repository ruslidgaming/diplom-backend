<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        return view('main.loginForm.admin-login');
    }
    public function loginMetodist()
    {
        return view('main.loginForm.metodist-login');
    }
    public function registerWeb()
    {
        return view('main.register');
    }
    public function register(Request $request)
    {
        // as
        $user = $request->validate(
            [
                'name' => 'required|string|max:128',
                'surname' => 'required|string|max:128',
                'oldname' => 'nullable|string|max:128',
                'companyName' => 'required|string|max:128',
                'companyDescription' => 'required|string|max:1024',
                'telephon' => 'required|string|max:20|regex:/^\+?[0-9\s\-()]{7,}$/',
                'email' => 'required|email|unique:admins',
                'password' => 'required|min:8|confirmed',
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
                'telephon.regex' => 'Поле "Телефон" не корректно',

                'email.email' => 'Поле "email" некорректно',
                'password.min' => 'Поле "Пароль" должно быть не менее 8 символов',
                'password.confirmed' => 'Пароли не совпадают'
            ]

        );

        $user = Admin::create($user);

        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $val = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'Поле email обязательно для заполнения',
            'email.email' => 'Введите корректный email адрес',
            'password.required' => 'Поле пароль обязательно для заполнения',
            'password.string' => 'Пароль должен быть строкой',
            'password.min' => 'Пароль должен содержать минимум 8 символов'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('index');
        };

        return redirect()->route('login');
    }

    public function getAdmin()
    {
        $adminId = Auth::guard('admin')->id();
        // dd($adminId)

    }

    public function logout()
    {
        auth('admin-api')->logout();

        return response()->json(true, 201);
    }
}
