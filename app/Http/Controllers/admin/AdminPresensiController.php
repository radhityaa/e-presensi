<?php

namespace App\Http\Controllers\admin;

use App\Helpers\DifferenceTime;
use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PresensiResource;
use App\Models\Presensi;
use App\Models\SettingLocation;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AdminPresensiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin|staff|walikelas']);
    }

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
                    $btnShow = '<button type="button" id="btn-show" onclick="show(' . $row->id . ')" data-time="' . $absenceTimeIn . '" data-formatted-time="'  . $formattedTime . '" class="btn btn-sm btn-success"><i class="ti ti-pencil"></i></button>';
                    return '<div class="btn-group">' . $btnShow . '</div>';
                })
                ->rawColumns(['picture_in', 'picture_out', 'keterangan', 'action'])
                ->make(true);
        } else {
            return view('admin.presensi.index', compact('formattedTime'));
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'jam_in' => 'required',
            'jam_out' => 'required',
            'nik' => 'required',
        ]);

        $location = SettingLocation::first();

        try {
            DB::beginTransaction();
            Presensi::create([
                'student_id' => $request->nik,
                'jam_in' => $request->jam_in,
                'jam_out' => $request->jam_out,
                'picture_in' => 'default.png',
                'picture_out' => 'default.png',
                'location_in' => $location->location,
                'location_out' => $location->location
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function show(Presensi $presensi)
    {
        return response()->json($presensi);
    }

    public function edit(Presensi $presensi)
    {
        //
    }

    public function update(Request $request, Presensi $presensi)
    {
        $request->validate([
            'jam_in' => 'required',
            'jam_out' => 'required'
        ]);

        $location = SettingLocation::first();

        $presensi->update([
            'jam_in' => $request->jam_in,
            'jam_out' => $request->jam_out,
            'location_in' => $location->location,
            'location_out' => $location->location,
            'picture_in' => 'default.png',
            'picture_out' => 'default.png'
        ]);
    }

    public function destroy(Presensi $presensi)
    {
        //
    }
}
