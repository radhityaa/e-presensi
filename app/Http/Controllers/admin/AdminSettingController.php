<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
