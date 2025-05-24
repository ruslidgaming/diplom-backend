<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Log;

class CourseController extends Controller
{
    public function add(Request $request) {
        // $val = $request->validate([
        //     'name' => 'required|string|max:128',
        //     'price' => 'required|numeric|max:64',
        //     'mini_description' => 'required|string|max:256',
        //     'description' => 'required|string|max:512',
        //     'image' => 'mimes:png,jpeg,svg|required,'
        // ], [
        //     'name.required' => 'Поле "название" должно быть обязательным',
        //     'price.required' => 'Поле "цена" должно быть обязательным',
        //     'mini_description.required' => 'Поле "небольшое описание" должно быть обязательным',
        //     'description.required' => 'Поле "описание" должно быть обязательным',
        //     'image.required' => 'Изображение должно быть обязательным',

        //     'name.max' => 'Поле "название" не должно превышать 128 символов',
        //     'price.max' => 'Поле "цена" не должно превышать 64 символа',
        //     'mini_description.max' => 'Поле "небольшое описание" не должно превышать 256 символа',
        //     'description.max' => 'Поле "описание" не должно превышать 512 символов',

        //     'image.mimes' => 'Для изображения разрешены форматы: png, jpeg, svg',
        // ]);

        // $val['image'] = $request->file('image')->store('upload', 'public');

        // Course::create($val);

        Log::info('aboutCourse: ' . $request->input('aboutCourse'));
    Log::info('cardDescription: ' . $request->input('cardDescription'));

    // courseCards — JSON-строка, декодируем
    $courseCardsRaw = $request->input('courseCards');
    $courseCards = json_decode($courseCardsRaw, true);
    Log::info('courseCards:', $courseCards ?? []);

    // mentorCards — тоже JSON
    $mentorCardsRaw = $request->input('mentorCards');
    $mentorCards = json_decode($mentorCardsRaw, true);
    Log::info('mentorCards:', $mentorCards ?? []);

    $count = 1;
    for ($i = 0; $i < $count; $i++) {
        Log::info('mentorImage' . $i . $request->file('mentorImage_' . $i));
    }

    // Log::info('mentorImage_0:'. $request->file('mentorImage_0'));
    // Log::info('mentorImage_0:'. $request->file('mentorImage_0'));
    // Log::info('mentorImage_0:'. $request->file('mentorImage_0'));
    // Log::info('mentorImage_0:'. $request->file('testImg'));


    Log::info('courseImage:'. $request->file('courseImage'));

    // Файл courseImage
    if ($request->hasFile('courseImage')) {
        $file = $request->file('courseImage');
        $filename = $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename, 'public');
        Log::info("Файл courseImage сохранён: " . $path);
    } else {
        Log::info("Файл courseImage не передан.");
    }

    return response()->json([
        'message' => 'Данные получены',
        'courseCards' => $courseCards,
        'mentorCards' => $mentorCards,
        'filename' => $filename ?? null,
    ], 200);

    }

    public function update(Request $request) {
        $val = $request->validate([
            'name' => 'required|string|max:128',
            'price' => 'required|numeric|max:64',
            'mini_description' => 'required|string|max:256',
            'description' => 'required|string|max:512',
            'image' => 'mimes:png,jpeg,svg|nullable,'
        ], [
            'name.required' => 'Поле "название" должно быть обязательным',
            'price.required' => 'Поле "цена" должно быть обязательным',
            'mini_description.required' => 'Поле "небольшое описание" должно быть обязательным',
            'description.required' => 'Поле "описание" должно быть обязательным',

            'name.max' => 'Поле "название" не должно превышать 128 символов',
            'price.max' => 'Поле "цена" не должно превышать 64 символа',
            'mini_description.max' => 'Поле "небольшое описание" не должно превышать 256 символа',
            'description.max' => 'Поле "описание" не должно превышать 512 символов',

            'image.mimes' => 'Для изображения разрешены форматы: png, jpeg, svg',
        ]);

        if (isset($val['image'])) {
            $val['image'] = $request->file('image')->store('upload', 'public');
        }

        Course::where('id', $request->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'mini_description' => $request->mini_description,
            'description' => $request->description,
            'image' => $val['image'],
        ]);

        return response()->json(true, 201);
    }

    public function delete(Request $request) {
        Course::where('id', $request->id)->delete();

        return response()->json(true, 201);
    }
}
