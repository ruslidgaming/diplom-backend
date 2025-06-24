<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Progress;
use App\Models\Statistic;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function register(Request $request)
    {
        // $val = $request->validate([
        //     'name' => 'required|string|max:64',
        //     'surname' => 'required|string|max:64',
        //     'oldname' => 'nullable|string|max:64',
        //     'telephon' => 'required|regex:/^\+?[0-9\s\-()]{7,}$/',
        //     'email' => 'required|email|',
        //     'password' => 'required|min:8'
        // ],[
        //     'name.required' => 'Поле "имя" обязательное',
        //     'surname.required' => 'Поле "фамилия" обязательное',
        //     'telephon.required' => 'Поле "телефон" обязательное',
        //     'email.required' => 'Поле "email" обязательное',
        //     'password.required' => 'Поле "пароль" обязательное',


        //     'name.max' => 'Поле "имя" не должно превышать 64 символа',
        //     'surname.max' => 'Поле "фамилия" не должно превышать 64 символа',
        //     'oldname.max' => 'Поле "отчество" не должно превышать 64 символа',

        //     'email.email' => 'Поле "email" некорректно',
        //     'telephon.regex' => 'Поле "телефон" некорректно',

        //     'password.min' => 'Пароль должен минимум состоять из 8 символов',
        // ]);

        $user = Student::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'oldname' => $request->oldname,
            'telephon' => $request->telephon,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin_id' => $request->id,
            Rule::unique('students')->where(function ($query) use ($request) {
            return $query->where('admin_id', $request->admin_id);
        }),
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (!$token = auth('student-api')->attempt($credentials)) {
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
        $user = auth('student-api')->user();
        $user->role = 'student';

        return response()->json([
            'access_token' => $token,
            // 'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 120,
            'user' => $user,
        ]);
    }

    public function all(Request $request)
    {
        $course = Course::where('admin_id', $request->id)->get();
        return response()->json(['course' => $course], 201);
    }

    public function my(Request $request)
    {
        $courseIds = Progress::where('student_id', $request->id)
            ->distinct()
            ->pluck('course_id');

        $courses = Course::whereIn('id', $courseIds)->get();

        return response()->json(["courses" => $courses], 200);
    }

    public function pay(Request $request)
    {

        $course = Course::where('id', $request->idCourse)->first();

        $lessonsList = Lesson::where('course_id', $request->idCourse)->get();
        foreach ($lessonsList as $value) {
            Progress::create([
                "course_id" => $request->idCourse,
                "student_id" => $request->idUser,
                "lesson_id" => $value->id,
                "complete" => false,
            ]);
        }

        $id = auth('student-api')->id();

        Statistic::create([
            'student_id' => $id,
            'course_id' => $request->idCourse,
            'price' => $course->price
        ]);

        return response()->json(201);
    }

    public function end(Request $request)
    {
        $id = auth('student-api')->id();

        $id = 2;

        $courses = Course::with('lesson')->get();

        $completedCourses = [];

        foreach ($courses as $course) {
            $totalLessons = $course->lesson->count();
            if ($totalLessons == 0) continue;

            // Считаем сколько уроков пройдено студентом
            $completedLessons = Progress::where('student_id', $id)
                ->where('course_id', $course->id)
                ->where('complete', true)
                ->count();

            if ($completedLessons == $totalLessons) {
                $completedCourses[] = $course;
            }
        }

        return response()->json(["courses" => $completedCourses], 200);
    }

    public function finish(Request $request)
    {
        $progress = Progress::where([
            'student_id' => $request->id,
            'course_id' => $request->idCourse,
            'lesson_id' => $request->lessonId
        ])->first();

        $progress->update(['complete' => true]);

        $progressInfo = Progress::where('student_id', $request->id)->get();

        for ($i = 0; $i < count($progressInfo); $i++) {
            if ($request->lessonId == $progressInfo[$i]->lesson_id) {
                if (isset($progressInfo[$i + 1])) {
                    return response()->json(['finish' => $progressInfo[$i + 1]->lesson_id], 201);
                } else {
                    return response()->json(['finish' => "finish"], 201);
                }
            }
        }
    }

    public function lessonsList(Request $request)
    {
        $title = Course::findOrFail($request->idCourse)->name;
        $progress = Progress::where(['student_id' => $request->userId, "course_id" =>  $request->idCourse])->get();

        $lessonsList = [];
        foreach ($progress as $value) {
            $info = Lesson::findOrFail($value->lesson_id);
            $info->complete = $value->complete;
            $lessonsList[] = $info;
        }

        return response()->json(["lessonsList" => $lessonsList, 'title' => $title], 201);
    }

    public function logout()
    {
        auth('student-api')->logout();

        return response()->json(true, 201);
    }
}
