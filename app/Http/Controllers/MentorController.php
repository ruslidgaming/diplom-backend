<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Menourse;
use App\Models\Mentor;
use DB;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Str;

class MentorController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->only('login', 'password');

        if (!$token = auth('mentor-api')->attempt($credentials)) {
            return response()->json(['error' => 'Неверный email или пароль'], 401);
        }

        $user = auth('mentor-api')->user();
        $user->role = 'mentor';

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 3600,
            'user' => $user,
        ]);
    }

    public function catalog()
    {
        $id = auth('admin-api')->id();
        $metodists = Mentor::where("admin_id", $id)->get();
        return response()->json($metodists, 200);
    }



    public function create(Request $request)
    {
        Log::debug('Request: ', $request->all());

        $id = auth('admin-api')->id();

        $image = $request->file('image')->store('upload', 'public');

        try {
            $mentor = Mentor::create([
                'name' => $request->name,
                'login' => $request->login,
                'password' => $request->password,
                'image' => $image,
                'admin_id' => $id
            ]);
        }
        catch (UniqueConstraintViolationException $e) {
            // Обработка ошибки дублирования логина
            return response()->json([
                'success' => false,
                'message' => 'Логин уже занят, выберите другой',
                'error' => $e->getMessage()
            ], 422);
        }

        $courses = json_decode($request->input('courses'), true);

        foreach ($courses as $id) {
                Menourse::create([
                    'mentor_id' => $mentor->id,
                    'course_id' => $id,
                ]);
            }
        $user = Mentor::where('id', $request->id)->first();
        return response()->json(['user' => $user], 201);
    }

    public function update(Request $request)
    {

        Log::debug('Request: ', $request->all());

        $image = $request->file('courseImage')->store('upload', 'public');

        $courses = $request->courses;

        Log::debug('Courses: ' . $courses);

        Mentor::where('id', $request->id)->update([
            'name' => $request->name,
            'login' => $request->login,
            'password' => $request->password,
            'image'->$image,
        ]);
        $mentor = Mentor::where('id', $request->id)->first();

        foreach ($courses as $course) {
            $idCourse = $course['id'];
            Menourse::create([
                'mentor_id' => $mentor->id,
                'course_id' => $idCourse,
            ]);
        }
        $user = Mentor::where('id', $request->id)->first();

        return response()->json(['user' => $user], 201);
    }

    public function delete(Request $request){

        Mentor::findOrFail($request->id)->delete();
        return response()->json([], 201);
    }
    public function edit(Request $request){
        return response()->json([Mentor::findOrFail($request->id)], 201);
    }

    public function logout()
    {
        auth('mentor-api')->logout();

        return response()->json(true, 201);
    }
}
