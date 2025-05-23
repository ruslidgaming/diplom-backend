<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function add(Request $request) {
        $val = $request->validate([
            'name' => 'required|string|max:128',
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:20480',
            'image' => 'nullable|file|mimes:png,jpeg,svg',
            'content' => 'required|string',
        ], 
    [
        'name.required' => 'Поле "название" должно быть обязательным',
        'name.max' => 'Поле "название" не должно содержать более 128 символов',
        'content.required' => 'Поле "контент" должно быть обязательным',

        'video.mimes' => 'Поле "видео" должно быть в формате: mp4, mov, avi',
        'image.mimes' => 'Поле "фото" должно быть в формате: png, jpeg, svg',
    ]);

        $val['video'] = $request->file('video')->store('upload', 'public');

        $val['image'] = $request->file('image')->store('upload', 'public');


        Lesson::create([
            'name' => $request->name,
            'content' => $request->content,
            'video' => $val['video'],
            'image' => $val['image'],
            'course_id' => $request->course_id
        ]);

        return response()->json(true, 201);
    }

    public function update(Request $request) {
        $val = $request->validate([
            'name' => 'required|string|max:128',
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:20480',
            'image' => 'nullable|file|mimes:png,jpeg,svg',
            'content' => 'required|string',
        ], 
    [
        'name.required' => 'Поле "название" должно быть обязательным',
        'name.max' => 'Поле "название" не должно содержать более 128 символов',
        'content.required' => 'Поле "контент" должно быть обязательным',

        'video.mimes' => 'Поле "видео" должно быть в формате: mp4, mov, avi',
        'image.mimes' => 'Поле "фото" должно быть в формате: png, jpeg, svg',
    ]);
        if (isset($val['image'])) {
            $val['image'] = $request->file('image')->store('upload', 'public');
        }

        if (isset($val['video'])) {
            $val['video'] = $request->file('video')->store('upload', 'public');
        }

        Lesson::where('id', $request->id)->update([
            'name' => $request->name,
            'content' => $request->content,
            'video' => $val['video'],
            'image' => $val['image'],
        ]);

        return response()->json(true, 201);
    }

    public function delete(Request $request) {
        Lesson::where('id', $request->id)->delete();

        return response()->json(true, 201);

    }
}
