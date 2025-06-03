<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function add(Request $request)
    {
        $val = $request->validate(
            [
                'name' => 'required|string|max:128',
                // 'video' => 'required|file|mimes:mp4,mov,avi|max:20480',
                // 'image' => 'required|file|mimes:png,jpeg,svg',
                'content' => 'required',
            ],
            [
                'name.required' => 'Поле "название" должно быть обязательным',
                'name.max' => 'Поле "название" не должно содержать более 128 символов',
                'content.required' => 'Поле "контент" должно быть обязательным',

                // 'video.mimes' => 'Поле "видео" должно быть в формате: mp4, mov, avi',
                // 'image.mimes' => 'Поле "фото" должно быть в формате: png, jpeg, svg',
            ]
        );

        // $val['video'] = $request->file('video')->store('upload', 'public');

        // $val['image'] = $request->file('image')->store('upload', 'public');


        $lesson = Lesson::create([
            'name' => $request->name,
            'content' => $request->content,
            // 'video' => $val['video'],
            // 'image' => $val['image'],
            'course_id' => $request->course_id
        ]);

        return response()->json($lesson, 201);
    }

    public function edit(Request $request)
    {
        $val = $request->validate(
            [
                'name' => 'required|string|max:128',
                'content' => 'required',
            ],
            [
                'name.required' => 'Поле "название" должно быть обязательным',
                'name.max' => 'Поле "название" не должно содержать более 128 символов',
                'content.required' => 'Поле "контент" должно быть обязательным',
            ]
        );

        Lesson::where('id', $request->id)->update([
            'name' => $request->name,
            'content' => $request->content,
        ]);

        return response()->json(true, 201);
    }

    public function delete(Request $request)
    {
        Lesson::where('id', $request->id)->delete();
        return response()->json(true, 201);
    }

    public function catalog(Request $request)
    {

        $lessons = Lesson::where('course_id', $request->id)->get();
        $title = Course::findOrFail($request->id)->name;

        return response()->json(["title" => $title, "lessons" => $lessons], 201);
    }

    public function show(Request $request)
    {
        return response()->json(Lesson::findOrFail($request->id), 201);
    }



    public function texting(Request $request)
    {
        return response()->json($request->all());
    }
}
