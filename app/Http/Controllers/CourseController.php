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

        return response()->json(true, 201);
    if ($request->hasFile('courseImage')) {
            $path = $request->file('courseImage')->store('images', 'public');
            Log::info('File uploaded: ' . $path);
            return response()->json(['path' => $path]);
        } else {
            Log::info('No file uploaded');
            return response()->json(['message' => 'No file']);
        }

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
