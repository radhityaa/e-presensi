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
        $classrooms = Classroom::orderBy('name')->get();

        return view('schedules.index', compact('classrooms'));
    }

    public function getClass()
    {
        $classrooms = Classroom::orderBy('name')->get();
        return response()->json($classrooms);
    }

    public function getSchedules(Request $request)
    {
        // $classroomId = $request->classroom_id;
        // // $day = $request->day;

        // $schedules = Schedule::with('subject', 'user', 'classroom')->where(['classroom_id' => $classroomId])->get();
        // return response()->json($schedules);

        $classroomId = $request->classroom_id;
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        $schedulesByDay = [];

        foreach ($days as $day) {
            $schedulesByDay[$day] = Schedule::with(['subject', 'user'])
                ->where('classroom_id', $classroomId)
                ->where('day', $day)
                ->get();
        }

        return response()->json($schedulesByDay);
    }
}
