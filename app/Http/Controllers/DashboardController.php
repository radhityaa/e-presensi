<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Submmission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->toDateString();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $studentId = Auth::guard('student')->user()->id;
        $presensiToday = Presensi::whereDate('created_at', $today)->where('student_id', $studentId)->first();
        $presensiMonth = Presensi::whereBetween('created_at', [$startOfMonth, $endOfMonth])->where('student_id', $studentId)->latest()->get();

        $rekapAbsen = Presensi::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total_absen, SUM(IF(jam_in > "07:00", 1, 0)) as total_absen_terlambat')
            ->where('student_id', $studentId)
            ->groupBy('year', 'month')
            ->first();

        $leaderboards = Presensi::join('students', 'presensis.student_id', '=', 'students.id')
            ->whereDate('presensis.created_at', $today)
            ->orderBy('jam_in')
            ->get();

        $recapSubmmission = Submmission::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month,
                                    SUM(IF(status = "i", 1, 0)) as total_izin,
                                    SUM(IF(status = "s", 1, 0)) as total_sakit')
            ->where('student_id', $studentId)
            ->where('approve', 1)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('year', 'month')
            ->first();

        return view('dashboard.index', compact('presensiToday', 'presensiMonth', 'rekapAbsen', 'leaderboards', 'recapSubmmission'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
