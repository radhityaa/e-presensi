<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DifferenceTime;
use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin|staff|walikelas']);
    }

    public function presensi()
    {
        $month = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $students = Student::orderBy('name')->get();

        return view('admin.report.presensi', compact('month', 'students'));
    }

    public function absensiPrint(Request $request)
    {
        $nik = $request->nik;
        $month = $request->month;
        $year = $request->year;
        $student = Student::where('nik', $nik)->first();
        $monthName = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $presensis = Presensi::where('student_id', $student->id)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->orderBy('created_at')
            ->get();

        foreach ($presensis as $item) {
            $item->image_in = $item->picture_in ? Storage::url('uploads/absensi/' . $item->picture_in) : null;
            $item->image_out = $item->picture_out ? Storage::url('uploads/absensi/' . $item->picture_out) : null;
            $item->difference = DifferenceTime::calculateTimeDifference('07:00:00', $item->jam_in);
        }

        return view('admin.report.print', compact('nik', 'month', 'monthName', 'year', 'student', 'presensis'));
    }

    public function rekap()
    {
        $month = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        return view('admin.report.rekap', compact('month'));
    }

    public function rekapPrint(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $monthName = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $daysSelect = [];
        for ($day = 1; $day <= 31; $day++) {
            $daysSelect[] = "MAX(IF(DAY(presensis.created_at) = $day, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) as tgl_$day";
        }

        $rekap = Presensi::selectRaw('students.nik, students.name, ' . implode(', ', $daysSelect))
            ->join('students', 'presensis.student_id', '=', 'students.id')
            ->whereMonth('presensis.created_at', $month)
            ->whereYear('presensis.created_at', $year)
            ->groupBy('students.nik', 'students.name')
            ->get();

        return view('admin.report.rekap_print', compact('month', 'monthName', 'year', 'rekap'));
    }
}
