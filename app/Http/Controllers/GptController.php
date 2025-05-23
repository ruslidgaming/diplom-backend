<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use Log;

class GptController extends Controller
{
    public function gpt() {
        $response = Http::post('http://192.168.1.101:5001/generate', [
        'prompt' => 'Once upon a time,',
        'max_tokens' => 10,
    ]);

    if ($response->successful()) {
        $data = $response->json();
        return $data['generated'] ?? 'Нет результата';
    }

    return 'Ошибка API: ' . $response->status();

    }
}
