<?php

// app/Http/Controllers/ProjectController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function load($id)
    {
        $project = Project::where('admin_id', $id)->first();

        if (!isset($project)) {
            return response()->json([], 200);
        }

        return response()->json($project);
    }

    public function store(Request $request, $id)
    {
        $data = json_encode($request->project);

        $html = $request->html;
        $css = $request->css;

        Log::debug('Логи:', $request->all());

        $project = Project::updateOrCreate(
            ['admin_id' => auth('admin-api')->id(), 'project_id' => $id],
            ['data' => $data, 'css' => $css, 'html' => $html]
        );

        return response()->json(['status' => 'saved']);
    }
}
