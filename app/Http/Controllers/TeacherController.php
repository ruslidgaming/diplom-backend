<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function delete(Request $request) {
        $id = $request->id;

        Teacher::where('id', $id)->delete();

        return response()->json(true, 200);
    }
}
