<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Menourse;
use App\Models\Mentor;
use DB;
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

        // Генерация refresh token
        // $refreshToken = Str::random(128);
        // $expiresAt = now()->addDays(7); // Срок жизни refresh token

        // Сохраняем refresh token в БД
        // DB::table('refresh_tokens')->insert([
        //     'token' => $refreshToken,
        //     'admin_id' => auth('admin-api')->id(),
        //     'expires_at' => $expiresAt,
        // ]);
        $user = auth('mentor-api')->user();
        $user->role = 'mentor';

        return response()->json([
            'access_token' => $token,
            // 'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 120,
            'user' => $user,
        ]);
    }

    public function create(Request $request) {
        Log::debug('Request: ', $request->all());

        $id = auth('admin-api')->id();

        $image = $request->file('image')->store('upload', 'public');

        $coursesJson = $request->input('courses'); // Получаем JSON-строку
        $courses = json_decode($coursesJson, true);

        Log::debug('Courses: ', $courses);

        $mentor = Mentor::create([
            'name' => $request->name,
            'login' => $request->login,
            'password' => $request->password,
            'image' => $image,
            'admin_id' => $id
        ]);

        foreach ($courses as $id) {
            Menourse::create([
                'mentor_id' => $mentor->id,
                'course_id' => $id,
            ]);
        }
        $user = Mentor::where('id', $request->id)->first();

        return response()->json(['user' => $user], 201);
    }

    public function update(Request $request){

        Log::debug('Request: ', $request->all());

        $image = $request->file('courseImage')->store('upload', 'public');

        $courses = $request->courses;

        Log::debug('Courses: ' . $courses);

        Mentor::where('id', $request->id)->update([
            'name' => $request->name,
            'login' => $request->login,
            'password' => $request->password,
            'image' -> $image,
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

    public function logout() {
        auth('mentor-api')->logout();

        return response()->json(true, 201);
    }
}
