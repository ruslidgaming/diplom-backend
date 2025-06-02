<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Feedback;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function admin()
    {
        return response()->json(Admin::where('role', 'admin')->get(), 201);
    }

    public function feedback()
    {
        return response()->json(Feedback::all(), 201);
    }
}
