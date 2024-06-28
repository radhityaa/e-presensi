<?php

namespace App\Http\Controllers;

use App\Helpers\DifferenceTime;
use App\Helpers\MyHelper;
use App\Models\Classroom;
use App\Models\Presensi;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Submmission;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::orderBy('name')->get();
        $students = Student::orderBy('name')->get();

        return view('welcome', compact('classrooms', 'students'));
    }

    public function getSchedules(Request $request)
    {
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

    public function getAbsensi(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|exists:students,nik',
            'date' => 'required|date',
        ]);

        $nik = $request->nik;
        $date = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');

        if (!$nik || !$date) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 400);
        }

        $absenceTimeIn = MyHelper::getAbsenceTime('in');
        $formattedTime = MyHelper::getAbsenceTime('in', true);


        $absence = Presensi::whereHas('student', function ($q) use ($nik) {
            $q->where('nik', $nik);
        })->with('student')->whereDate('created_at', $date)->first();


        if ($absence?->jam_in >= $formattedTime) {
            $difference = '<span class="badge bg-danger">Terlambat ' . DifferenceTime::calculateTimeDifference($absenceTimeIn, $absence?->jam_in) . ' </span>';
        } else {
            $difference = '<span class="badge bg-danger">Terlambat Tepat Waktu </span>';
        }

        if (!$absence) {
            $cekSubmission = Submmission::whereHas('student', function ($q) use ($nik) {
                $q->where('nik', $nik);
            })->with('student')->whereDate('created_at', $date)->first();

            return response()->json([
                'absence' => $absence,
                'difference' => $difference,
                'cekSubmission' => $cekSubmission,
            ]);
        }

        return response()->json([
            'absence' => $absence,
            'difference' => $difference,
        ]);
    }
}
