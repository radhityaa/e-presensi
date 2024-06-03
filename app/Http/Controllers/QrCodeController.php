<?php

namespace App\Http\Controllers;

use App\Models\Qrcode as ModelsQrcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can: staff')->only(['qrcode']);
    }

    public function generateQr()
    {
        $uuidGenerate = Uuid::uuid4();

        // $updateQr = ModelsQrcode::create(['uuid' => $uuidGenerate]);

        $from = [255, 0, 0];
        $to = [0, 0, 255];
        $qrcode = QrCode::size(400)
            ->style('dot')
            ->eye('circle')
            ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
            ->margin(1)
            ->generate($uuidGenerate);
        return response($qrcode);
    }

    public function qrcode()
    {
        return view('qr.scan');
    }

    public function scan()
    {
        return view('presensi.scan');
    }

    public function validation(Request $request)
    {
        $validationQr = ModelsQrcode::where('uuid', $request->qrcode)->where('student_id', Auth::user()->id)->first();
        if ($validationQr) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code Tidak Valid!'
            ]);
        }

        $qrcode = ModelsQrcode::create(['uuid' => $request->qrcode, 'student_id' => Auth::user()->id]);

        if ($qrcode) {
            return response()->json([
                'success' => true,
                'message' => 'Silahkan Absen!',
                'redirect' => route('presensi.index', $qrcode->uuid)
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'QR Code Tidak Valid!'
            ]);
        }
    }
}
