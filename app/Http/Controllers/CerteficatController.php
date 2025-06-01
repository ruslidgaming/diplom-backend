<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CerteficatController extends Controller
{
    public function cerf(Request $request) {
        $user = $request->user;
        $image = imagecreatefrompng('storage/my.png');

        // Цвет текста
        $black = imagecolorallocate($image, 0, 0, 0);

        // Путь к шрифту
        $fontPath = public_path('fonts/open-sans-bold2.ttf');

        // Пишем ФИО на изображение
        imagettftext($image, 20, 0, 140, 280, $black, $fontPath, $user);

        // Сохраняем или выводим
        header('Content-Type: image/jpeg');
        imagepng($image);
        imagedestroy($image);
    }
}
