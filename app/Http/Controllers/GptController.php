<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use Log;

class GptController extends Controller
{
    public function gpt(Request $request) {
        $promt = $request->promt;
        $max_tokens = $request->max_tokens;
        $response = Http::post('http://192.168.1.101:5001/generate', [
        'prompt' => 'how are you?',
        'max_tokens' => $max_tokens,
    ]);

    if ($response->successful()) {
        $data = $response->json();
        return $data['generated'] ?? 'Нет результата';
    }

    return 'Ошибка API: ' . $response->status();

    }
}
