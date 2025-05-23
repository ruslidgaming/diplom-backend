<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function feedback(Request $request) {
        $val = $request->validate([
            'name' => 'required|string|max:64',
            'telephon' => 'required|regex:/^\+?[0-9\s\-()]{7,}$/'
        ], [
            'name.required' => 'Поле "имя" обязательно',
            'name.max' => 'Максимальная длина имени 64 символа',

            'telephon.required' => 'Поле "телефон" обязательно',
            'telephon.regex' => 'Поле "телефон" некорректно',
        ]);

        Feedback::create([
            'name' => $request->name,
            'telephon' => $request->telephon,
            'admin_id' => $request->id,
        ]);

        return response()->json(true, 201);
    }
}
