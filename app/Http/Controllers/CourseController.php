<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Mentor;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Log;


class CourseController extends Controller
{
    public function index(){}
    public function create(){}
    public function store(Request $request){}
    public function show(string $id){}
    public function edit(string $id){}
    public function update(Request $request, string $id){}
    public function destroy(string $id){}
    public function add(Request $request)
    {
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

        $image = $request->file('courseImage')->store('upload', 'public');
        $id = auth('admin-api')->id();
        $course = Course::create([
            'name' => $request->title,
            'price' => $request->price,
            'mini_description' => $request->cardDescription,
            'slogan' => $request->slogan,
            'description' => $request->aboutCourse,
            'course_info' => $request->courseCards,
            'admin_id' => $id,
            'image' => $image,
        ]);

        $mentorCardsRaw = $request->input('mentorCards');
        $mentorCards = json_decode($mentorCardsRaw, true);

        $count = $request->count;
        for ($i = 0; $i < $count; $i++) {
            $image = $request->file('mentorImage_' . $i)->store('upload', 'public');
            Teacher::create([
                'name' => $mentorCards[$i]['name'],
                'description' => $mentorCards[0]['description'],
                'image' => $image,
                'course_id' => $course->id,
            ]);
        }

        return response()->json(true, 200);
    }

    public function rqew(Request $request)
    {
        // $val = $request->validate([
        //     'name' => 'required|string|max:128',
        //     'price' => 'required|numeric|max:64',
        //     'mini_description' => 'required|string|max:256',
        //     'description' => 'required|string|max:512',
        //     'image' => 'mimes:png,jpeg,svg|nullable,'
        // ], [
        //     'name.required' => 'Поле "название" должно быть обязательным',
        //     'price.required' => 'Поле "цена" должно быть обязательным',
        //     'mini_description.required' => 'Поле "небольшое описание" должно быть обязательным',
        //     'description.required' => 'Поле "описание" должно быть обязательным',

        //     'name.max' => 'Поле "название" не должно превышать 128 символов',
        //     'price.max' => 'Поле "цена" не должно превышать 64 символа',
        //     'mini_description.max' => 'Поле "небольшое описание" не должно превышать 256 символа',
        //     'description.max' => 'Поле "описание" не должно превышать 512 символов',

        //     'image.mimes' => 'Для изображения разрешены форматы: png, jpeg, svg',
        // ]);

        // if (isset($val['image'])) {
        //     $val['image'] = $request->file('image')->store('upload', 'public');
        // }

        $image = $request->file('courseImage')->store('upload', 'public');
        $id = auth('admin-api')->id();

        $data = [
            'name' => $request->title,
            'price' => $request->price,
            'mini_description' => $request->cardDescription,
            'slogan' => $request->slogan,
            'description' => $request->aboutCourse,
            'course_info' => $request->courseCards,
            'admin_id' => $id,
        ];

        if ($request->hasFile('courseImage')) {
            $data['image'] = $request->file('courseImage')->store('upload', 'public');
        }

        Course::where('id', $request->idCourse)->update($data);
        $course = Course::where('id', $request->idCourse)->first();


        $mentorCardsRaw = $request->input('mentorCards');
        $mentorCards = json_decode($mentorCardsRaw, true);

        $count = $request->count;
        for ($i = 0; $i < $count; $i++) {
            $image = $request->file('mentorImage_' . $i)->store('upload', 'public');
            Teacher::create([
                'name' => $mentorCards[$i]['name'],
                'description' => $mentorCards[0]['description'],
                'image' => $image,
                'course_id' => $course->id,
            ]);
        }

        return response()->json(true, 200);
    }

    public function delete(Request $request)
    {
        Course::where('id', $request->id)->delete();

        return response()->json(true, 201);
    }

    public function catalog(Request $request)
    {
        $adminId = auth('admin-api')->id();


        $courses = Course::where('admin_id', $adminId)->get();

        return response()->json(['courses' => $courses], 200);
    }

    public function dfg(Request $request)
    {
        $id = $request->id;
        // Log::info('Request data: ', $request->all());

        $course = Course::where('id', $id)->first();

        $teachers = Teacher::where('course_id', $id)->get();

        return response()->json(['course' => $course, 'teachers' => $teachers], 200);
    }
}
