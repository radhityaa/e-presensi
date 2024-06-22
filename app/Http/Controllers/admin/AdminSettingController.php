<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsenceTime;
use App\Models\SettingLocation;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin|staff']);
    }
    public function location(Request $request)
    {
        $location = SettingLocation::first();

        if ($request->isMethod('put')) {
            $location->update($request->all());

            notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addSuccess('Lokasi Berhasil Diubah');
            return back();
        };

        return view('admin.settings.location', compact('location'));
    }

    public function absenceTime(Request $request)
    {
        $absence_time = AbsenceTime::first();

        if ($request->isMethod('put')) {
            $absence_time->update([
                'time_in' => $request->time_in,
                'time_out' => $request->time_out
            ]);

            notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addSuccess('Jam Absen Berhasil Diubah');
            return back();
        }

        return view('admin.settings.absence-time', compact('absence_time'));
    }
}
