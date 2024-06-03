<?php

namespace App\Http\Controllers;

use App\Models\Submmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class SubmmissionController extends Controller
{
    public function index()
    {
        $submissions = Submmission::where('student_id', Auth::guard('student')->user()->id)->get();
        return view('presensi.submission.index', compact('submissions'));
    }

    public function create()
    {
        return view('presensi.submission.create');
    }

    public function store(Request $request)
    {
        Submmission::create([
            'uuid' => Uuid::uuid4(),
            'student_id' => Auth::guard('student')->user()->id,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect(route('submission.index'))->with(['success' => 'Pengajuan Berhasil, Menunggu Approve']);
    }
}
