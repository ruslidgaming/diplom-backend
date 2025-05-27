<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Log;

class GptController extends Controller
{
    public function gpt(Request $request) {
        $apiKey = env('DEEPSEEK_API_KEY');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $apiKey,
        ])->post('https://deepseekapiio.erweima.ai/api/v1/chat/completions', [
            'model' => 'deepseek-chat',
            'messages' => [
                [ "role" => "system", "content" => "Ты — помощник, помогай вежливо" ],
                [ "role" => "user", "content" => "Привет!" ],
                [ "role" => "assistant", "content" => "Привет! Чем могу помочь?" ],
                [ "role" => "user", "content" => "Расскажи анекдот" ]
            ],
            'maxTokens' => 1024,
            // 'stream' => true, // ❌ НЕ нужно
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([
                'error' => 'Ошибка запроса к DeepSeek',
                'status' => $response->status(),
                'body' => $response->body(),
            ], $response->status());
        }

    }
}
