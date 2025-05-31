<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function upload(Request $request)
    {
        $files = $request->file('files');

        $uploaded = [];
        foreach ($files as $file) {
            $path = $file->store('public/assets');
            $url = Storage::url($path);

            $uploaded[] = [
                'id' => basename($path), // ID для удаления
                'src' => asset($url),
                'name' => $file->getClientOriginalName(),
                'mimeType' => $file->getMimeType(),
                'size' => $file->getSize(),
                'meta' => [
                    'uploadedAt' => now()->toISOString()
                ]
            ];
        }
        Log::debug('message', $uploaded);

        return response()->json($uploaded);
    }

    public function delete(Request $request)
    {
        $assets = $request->input('assets', []);

        foreach ($assets as $asset) {
            if (isset($asset['id']) && Storage::exists($asset['id'])) {
                Storage::delete($asset['id']);
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function index()
    {
        // Возвращайте ассеты, если нужно их загружать при инициализации
    }
}
