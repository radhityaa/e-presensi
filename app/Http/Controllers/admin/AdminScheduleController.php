<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\Objects;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminScheduleController extends Controller
{
    public function index(Request $request)
    {
        $classrooms = Classroom::orderBy('name')->get();

        return view('admin.schedules.index', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'day'          => 'required',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i',
            'subject_id'   => 'required|exists:subjects,id',
            'user_id'      => 'required|exists:users,id'
        ]);

        try {
            Schedule::create([
                'classroom_id' => $request->classroom_id,
                'day' => $request->day,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'subject_id' => $request->subject_id,
                'user_id' => $request->user_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil ditambahkan'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan jadwal, Coba lagi :' + $th->getMessage()
            ], 400);
        }
    }

    public function list(Request $request)
    {
        $classroomId = $request->classroom_id;
        $day = $request->day;

        $schedules = Schedule::with('subject', 'user', 'classroom')->where(['classroom_id' => $classroomId, 'day' => $day])->get();
        return response()->json($schedules);
    }

    public function subjects()
    {
        $subjects = Subject::orderBy('name')->get();
        return response()->json($subjects);
    }

    public function users()
    {
        $users = User::orderBy('name')->get();
        return response()->json($users);
    }

    public function destroy($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan'
            ], 404);
        }

        $schedule->delete();
        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil dihapus'
        ]);
    }

    public function edit($id)
    {
        $schedule = Schedule::find($id)->load('subject', 'user', 'classroom');

        if (!$schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan'
            ], 404);
        }

        return response()->json($schedule);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'start_time'   => 'required',
            'end_time'     => 'required',
            'subject_id'   => 'required|exists:subjects,id',
            'user_id'      => 'required|exists:users,id'
        ]);

        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan'
            ], 404);
        }

        $schedule->update([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'subject_id' => $request->subject_id,
            'user_id' => $request->user_id,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil diubah'
        ]);
    }
}
