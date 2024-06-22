<?php

namespace App\Http\Controllers\admin;

use App\Helpers\DifferenceTime;
use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PresensiResource;
use App\Models\AbsenceTime;
use App\Models\Presensi;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $today = date('Y-m-d');
        $absenceTimeIn = MyHelper::getAbsenceTime('in');
        $absenceTimeOut = MyHelper::getAbsenceTime('out');
        $formattedTime = MyHelper::getAbsenceTime('in', true);

        if ($request->wantsJson()) {
            $query = Presensi::whereDate('created_at', $today)->get();
            if ($request->filter) {
                $query = Presensi::whereDate('created_at', $request->filter)->get();
            }

            return DataTables::of(PresensiResource::collection($query))
                ->addIndexColumn()
                ->editColumn('picture_in', function ($row) {
                    return $row->picture_in ? '<a href="' . url(Storage::url('uploads/absensi/' . $row->picture_in)) . '" data-lightbox="' . $row->picture_in . '"><img src="' . url(Storage::url('uploads/absensi/' . $row->picture_in)) . '" class="img-fluid rounded-circle avatar avatar-xl" style="width: 60px; height: 60px;"></a>' : '';
                })
                ->editColumn('picture_out', function ($row) {
                    return $row->picture_out ? '<a href="' . url(Storage::url('uploads/absensi/' . $row->picture_out)) . '" data-lightbox="' . $row->picture_out . '"><img src="' . url(Storage::url('uploads/absensi/' . $row->picture_out)) . '" class="img-fluid rounded-circle avatar avatar-xl" style="width: 60px; height: 60px;"></a>' : '<i class="fa-regular fa-clock" style="font-size: 25px;"></i>';
                })
                ->addColumn('keterangan', function ($row) use ($absenceTimeIn, $formattedTime) {
                    if ($row->jam_in >= $formattedTime) {
                        $difference = DifferenceTime::calculateTimeDifference($absenceTimeIn, $row->jam_in);
                        return '<span class="badge bg-danger">' . 'Terlambat ' . $difference . '</span>';
                    } else {
                        return '<span class="badge bg-success">Tepat Waktu</span>';
                    }
                })
                ->addColumn('action', function ($row) use ($absenceTimeIn, $formattedTime) {
                    $btnShow = '<button type="button" id="btn-show" onclick="show(' . $row->id . ')" data-time="' . $absenceTimeIn . '" data-formatted-time="'  . $formattedTime . '" class="btn btn-sm btn-success"><i class="ti ti-eye"></i></button>';
                    return '<div class="btn-group">' . $btnShow . '</div>';
                })
                ->rawColumns(['picture_in', 'picture_out', 'keterangan', 'action'])
                ->make(true);
        } else {
            $rekapAbsen = Presensi::selectRaw('COUNT(student_id) as total_hadir, SUM(IF(jam_in > ?, 1, 0)) as total_terlambat', [$formattedTime])
                ->whereDate('created_at', Carbon::today())
                ->first();

            $recapSubmmission = DB::table('submmissions')
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(IF(status = "i", 1, 0)) as total_izin'), DB::raw('SUM(IF(status = "s", 1, 0)) as total_sakit'))
                ->where('approve', 1)
                ->groupBy('date')
                ->first();

            $students = Student::count();

            return view('admin.dashboard', compact('rekapAbsen', 'recapSubmmission', 'students', 'formattedTime'));
        }
    }
}
