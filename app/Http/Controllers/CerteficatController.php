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

        $image = imagecreatefrompng('storage/' . $course->image);
        $black = imagecolorallocate($image, 0, 0, 0);

        $fontPath = public_path('fonts/Roboto_SemiCondensed-Medium.ttf');

        if (!file_exists($fontPath)) {
            abort(500, 'Файл шрифта не найден: ' . $fontPath);
        }



        $img = imagettftext($image, 20, 0, $course->coordinate_x, $course->coordinate_y, $black, $fontPath, $user);
        return response()->json(['url' => $img]);
        Storage::put('public/certif/' . $img);
        return response()->json(['url' => asset('storage/certif/' . $img)]);
    }
}
