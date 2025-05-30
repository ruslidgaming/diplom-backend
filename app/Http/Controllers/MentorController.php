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


        $courses = json_decode($request->input('courses'), true);

        $data = [
            'name' => $request->name,
            'login' => $request->login,
        ];

        if (isset($request->password)) {
            $data['password'] = $request->password;
        }

        if ($request->hasFile('courseImage')) {
            $data['image'] = $request->file('courseImage')->store('upload', 'public');
        }

        if (isset($request->password)) {
            Mentor::where('id', $request->id)->update($data);
        }

        return response()->json([], 201);
    }

    public function delete(Request $request){

        $id = $request->id;
        Mentor::findOrFail($id)->delete();
        return response()->json([], 201);
    }
    public function edit(Request $request){

        $mentor = Mentor::findOrFail($request->id);

        $data['metodist'] = $mentor;
        $data['courses'] = $mentor->courses;

        return response()->json($data, 201);
    }

    public function logout()
    {
        auth('mentor-api')->logout();

        return response()->json(true, 201);
    }
}
