<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CerteficatController extends Controller
{
    public function cerf(Request $request)
    {
        $user = $request->user['surname'] . ' ' . $request->user['name'] . ' ' . $request->user['oldname'];
        $course = Course::findOrFail($request->id);

        // Загружаем исходное изображение
        $imagePath = 'storage/' . $course->certificate;
        if (!file_exists($imagePath)) {
            abort(500, 'Исходное изображение не найдено: ' . $imagePath);
        }

        $image = imagecreatefrompng($imagePath);
        $black = imagecolorallocate($image, 0, 0, 0);

        $fontPath = public_path('fonts/Roboto_SemiCondensed-Medium.ttf');
        if (!file_exists($fontPath)) {
            abort(500, 'Файл шрифта не найден: ' . $fontPath);
        }

        // Добавляем текст на изображение
        imagettftext($image, 20, 0, $course->coordinate_x * 2, $course->coordinate_y * 3.05, $black, $fontPath, $user);

        // Генерируем уникальное имя для файла
        $filename = 'certificate_' . time() . '.jpg';
        $directory = 'public/sertificate';

        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        $fullPath = $directory . '/' . $filename;

        imagejpeg($image, storage_path('app/' . $fullPath));
        imagedestroy($image);

        // Возвращаем полный URL к изображению
        return response()->json([
            'url' => 'sertificate/' . $filename
            // 'url' => asset('storage/sertificate/' . $filename)
        ]);
    }
}
