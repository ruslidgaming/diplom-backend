<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Menourse;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MenourseController extends Controller
{
    public function delete(Request $request) {
        $idCourse = $request->idCourse;
        $metodistId = $request->metodistId;

        Menourse::where('course_id', $idCourse)->where('mentor_id', $metodistId)->delete();

        return response()->json(Mentor::findOrFail($metodistId)->courses, 201);

    }

    public function add(Request $request) {
        Menourse::create([
                'mentor_id' => $request->metodistId,
                'course_id' => $request->idCourse,
            ]);
        return response()->json(Mentor::findOrFail($request->metodistId)->courses, 201);
    }
}
