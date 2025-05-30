<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Mentor;
use Illuminate\Http\Request;

class MenourseController extends Controller
{
    public function delete(Request $request) {
        $idCourse = $request->idCourse;
        $metodistId = $request->metodistId;

        Course::findOrFail($idCourse)->delete();
        return response()->json(Mentor::findOrFail($request->metodistId)->courses, 201);

    }
}
