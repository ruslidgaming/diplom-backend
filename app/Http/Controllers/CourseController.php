<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Mentor;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Log;


class CourseController extends Controller
{
    public function add(Request $request)
    {

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

    public function update(Request $request)
    {
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


        $courses = Course::where('admin_id', $adminId)->orderBy('created_at', 'desc')->get();

        return response()->json(['courses' => $courses], 200);
    }

    public function show(Request $request)
    {
        $id = $request->id;
        // Log::info('Request data: ', $request->all());

        $course = Course::where('id', $id)->first();
        $lessons = Lesson::where('course_id', $id)->get();
        $teachers = Teacher::where('course_id', $id)->get();

        return response()->json(['course' => $course, 'teachers' => $teachers, 'lessons' => $lessons], 200);
    }
}
