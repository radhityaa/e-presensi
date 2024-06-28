<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $classrooms = Classroom::orderBy('name')->all();

        return view('schedules.index', compact('classrooms'));
    }

    public function getClass()
    {
        $classrooms = Classroom::orderBy('name')->all();
        return response()->json($classrooms);
    }
}
