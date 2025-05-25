<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Log;

class TeacherController extends Controller
{
    public function delete(Request $request) {
        $idTeacher = $request->idTeacher;
        $idCourse = $request->idCourse;

        Teacher::where('id', $idTeacher)->delete();

        $teachers = Teacher::where('course_id', $idCourse)->get();

        return response()->json($teachers, 200);
    }
}
