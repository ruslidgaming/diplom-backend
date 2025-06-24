<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Mentor;
use App\Models\Statistic;
use App\Models\Statistic2;
use App\Models\Student;
use Illuminate\Http\Request;
use Log;

class StatisticController extends Controller
{
    public function admin() {

        $id = auth('admin-api')->id();
        $id = 1;

        $totalEarnings = Statistic::join('courses', 'statistics.course_id', '=', 'courses.id')
            ->where('courses.admin_id', $id)
            ->sum('statistics.price');


        $students = Student::where('admin_id', $id)->count();

        $data = [
            'total' => $totalEarnings,
            'studdents' => $students,
        ];

        return response()->json($data);
    }

    public function super() {
        $id = auth('admin-api')->id();
        $id = 1;

        $EarningsStudent = Statistic::join('courses', 'statistics.course_id', '=', 'courses.id')
            ->sum('statistics.price');


        $EarningsAdmin = Statistic2::sum('statistic2s.price');


        $students = Student::all()->count();
        $admins = Admin::where('role', 'admin')->count();
        $mentors = Mentor::all()->count();


        $courses = Course::all()->count();
        $lessonos = Lesson::all()->count();


        $data = [
            'income' => [
                'student' => $EarningsStudent,
                'admin' => $EarningsAdmin
            ],

            'users' => [
                'students' => $students,
                'admins' => $admins,
                'mentors' => $mentors,
            ],

            'study' => [
                'courses' => $courses,
                'lessonos' => $lessonos,
            ]
        ];

        return response()->json($data);
    }
}
