<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use Log;

class GptController extends Controller
{
    public function gpt(Request $request) {
    $apiKey = env('OPENAI_API_KEY');  // Храни ключ в .env
    $prompt = $request->promt;
    $maxTokens = 200;
        $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $apiKey,
        'Content-Type' => 'application/json',
    ])->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-3.5-turbo', // или 'gpt-4'
        'messages' => [
            ['role' => 'user', 'content' => $prompt]
        ],
        'max_tokens' => $maxTokens,
        'temperature' => 0.7,
    ]);

    if ($response->successful()) {
        $data = $response->json();
        return $data['choices'][0]['message']['content'] ?? 'Нет ответа от модели';
    } else {
        throw new \Exception('Ошибка OpenAI API: ' . $response->body());
    }

    }
}
