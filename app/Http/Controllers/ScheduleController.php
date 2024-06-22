<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        // $classrooms = Classroom::with(['schedules' => function ($query) {
        //     $query->orderBy('day')->orderBy('start_time');
        // }, 'schedules.subject', 'schedules.user'])->get();
        // dd($classrooms);

        return view('schedules.index');
    }
}
