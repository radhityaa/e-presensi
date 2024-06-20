<?php

namespace App\Http\Controllers;

use App\Models\Qrcode as ModelsQrcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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
        ModelsQrcode::create(['qrcode' => $uuidGenerate]);

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
        $title = 'Scan QR Code';
        return view('presensi.scan', compact('title'));
    }

    public function validation(Request $request)
    {
        $qrcode = ModelsQrcode::where('qrcode', $request->qrcode)->first();

        if ($qrcode) {
            return response()->json([
                'success' => true,
                'redirect' => route('presensi.index', $qrcode->qrcode)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'QR Code Tidak Valid!'
        ]);
    }
}
