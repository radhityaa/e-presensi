<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Qrcode;
use App\Models\SettingLocation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function index($qrcode)
    {
        $title = 'Absen';
        $qrcode = Qrcode::where('qrcode', $qrcode)->first();

        if (!$qrcode) {
            return redirect(route('dashboard'));
        }

        $today = Carbon::now()->toDateString();
        $studentId = Auth::guard('student')->user()->id;
        $validate = Presensi::whereDate('created_at', $today)->where('student_id', $studentId)->first();
        $location = SettingLocation::first();

        return view('presensi.index', compact('validate', 'location', 'qrcode', 'title'));
    }

    public function store(Request $request)
    {
        $qrcode = Qrcode::where(['qrcode' => $request->qrcode])->first();

        if (!$qrcode) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code Tidak Valid!'
            ], 403);
        } else {
            $today = Carbon::now()->toDateString();
            $studentId = Auth::guard('student')->user()->id;
            $tgl_presensi = date('Y-m-d');
            $jam = date("H:i:s");
            $location = SettingLocation::first();
            $locationRadius = $location->radius;
            $location = explode(',', $location->location);

            $latOffice = $location[0];
            $lngOffice = $location[1];

            $location = $request->lokasi;
            $userLocation = explode(",", $location);
            $latUser = $userLocation[0];
            $lngUser = $userLocation[1];

            $distance = $this->distance($latOffice, $lngOffice, $latUser, $lngUser);
            $radius = round($distance["meters"]);

            $image = $request->image;
            $folderPath = "public/uploads/absensi/";
            $formatName = Auth::guard('student')->user()->nik . "_" . $tgl_presensi . "_" . Str::random(6);
            $imageParts = explode(";base64", $image);
            $imageBase64 = base64_decode($imageParts[1]);
            $fileName = $formatName . ".png";
            $file = $folderPath . $fileName;

            $absen = Presensi::whereDate('created_at', $today)->where('student_id', $studentId)->first();

            if ($radius > $locationRadius) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, Anda diluar Jangkauan!'
                ], 403);
            } else {
                if ($absen) {
                    $update = $absen->update([
                        'jam_out' => $jam,
                        'picture_out' => $fileName,
                        'location_out' => $location
                    ]);

                    if ($update) {
                        Storage::put($file, $imageBase64);
                        $qrcode->delete();

                        return response()->json([
                            'success' => true,
                            'type' => 'out',
                            'message' => "Absen Pulang Berhasil"
                        ], 200);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => "Internal Server Error"
                        ], 500);
                    }
                } else {
                    $save = Presensi::create([
                        'student_id' => Auth::guard('student')->user()->id,
                        'jam_in' => $jam,
                        'picture_in' => $fileName,
                        'location_in' => $location
                    ]);

                    if ($save) {
                        Storage::put($file, $imageBase64);
                        $qrcode->delete();

                        return response()->json([
                            'success' => true,
                            'type' => 'in',
                            'message' => "Absen Masuk Berhasil"
                        ], 200);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => "Internal Server Error"
                        ], 500);
                    }
                }
            }
        }
    }

    public function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);;
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;

        return compact('meters');
    }

    public function history()
    {
        $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return view('presensi.history.index', compact('month'));
    }

    public function getHistory(Request $request)
    {
        $studentId = Auth::guard('student')->user()->id;
        $month = $request->month;
        $year = $request->year;

        $histories = Presensi::whereRaw('MONTH(created_at)="' . $month . '"')
            ->whereRaw('YEAR(created_at)="' . $year . '"')
            ->where('student_id', $studentId)
            ->orderBy('created_at')
            ->get();

        return view('presensi.history.get', compact('histories'));
    }
}
