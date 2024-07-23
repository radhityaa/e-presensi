<?php

namespace App\Http\Controllers;

use App\Models\Submmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class SubmmissionController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Pengajuan Presensi';

        if ($request->ajax()) {
            $month = $request->month;
            $year = $request->year;

            $submissions = Submmission::where('student_id', Auth::guard('student')->user()->id)
                ->whereRaw('MONTH(created_at)="' . $month . '"')
                ->whereRaw('YEAR(created_at)="' . $year . '"')
                ->latest()
                ->paginate(5);

            $submissions->getCollection()->transform(function ($item) {
                $item->formatted_created_at = date('d-m-Y', strtotime($item->created_at));
                $item->formatted_approve_at = $item->approve_at ? $item->approve_at->format('d M Y') : null;
                $item->formatted_reject_at = $item->reject_at ? $item->reject_at->format('d M Y') : null;
                return $item;
            });

            return response()->json([
                'data' => $submissions->items(),
                'links' => (string) $submissions->links(),
            ]);
        }

        $submissions = Submmission::where('student_id', Auth::guard('student')->user()->id)->latest()->paginate(5);
        $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        return view('presensi.submission.index', compact('submissions', 'title', 'month'));
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
