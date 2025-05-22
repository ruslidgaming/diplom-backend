<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function register(Request $request) {
        $val = $request->validate([
            'name' => 'required|string|max:64',
            'surname' => 'required|string|max:64',
            'oldname' => 'nullable|string|max:64',
            'telephon' => 'required|regex:/^\+?[0-9\s\-()]{7,}$/',
            'email' => 'required|email|',
            'password' => 'required|min:8'
        ],[
            'name.required' => 'Поле "имя" обязательное',
            'surname.required' => 'Поле "фамилия" обязательное',
            'telephon.required' => 'Поле "телефон" обязательное',
            'email.required' => 'Поле "email" обязательное',
            'password.required' => 'Поле "пароль" обязательное',


            'name.max' => 'Поле "имя" не должно превышать 64 символа',
            'surname.max' => 'Поле "фамилия" не должно превышать 64 символа',
            'oldname.max' => 'Поле "отчество" не должно превышать 64 символа',

            'email.email' => 'Поле "email" некорректно',
            'telephon.regex' => 'Поле "телефон" некорректно',

            'password.min' => 'Пароль должен минимум состоять из 8 символов',
        ]);

        $user = Student::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'oldname' => $request->oldname,
            'telephon' => $request->telephon,
            'email' => $request->email,
            'password' => $request->password,
            'admin_id' => $request->id,
        ]);

        return response()->json(['user' => $user], 201);
    }
}
