<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubmissionResource;
use App\Models\Submmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AdminSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = Submmission::latest();

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status === 'i' ? 'Ijin' : 'Sakit';
                })
                ->editColumn('approve', function ($row) {
                    switch ($row->approve) {
                        case 0:
                            return '<span class="badge bg-warning">Pending</span>';
                            break;
                        case 1:
                            return '<span class="badge bg-success">Approve</span>';
                            break;
                        case 2:
                            return '<span class="badge bg-danger">Reject</span>';
                            break;
                    }
                })
                ->editColumn('created_at', function ($row) {
                    return date('d M Y H:i', strtotime($row->created_at));
                })
                ->addColumn('action', function ($row) {
                    $btnEdit = '<a href="' . route('admin.submission.edit', $row->uuid) . '" class="btn btn-sm btn-success"><i class="ti ti-eye"></i></a>';
                    return '<div class="btn-group">' . $btnEdit . '</div>';
                })
                ->rawColumns(['approve', 'action'])
                ->make(true);
        } else {
            return view('admin.submission.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Submmission $submmission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Submmission $submmission)
    {
        switch ($submmission->approve) {
            case 0:
                $approveName = 'Pending';
                break;
            case 1:
                $approveName = 'Approved';
                break;
            case 2:
                $approveName = 'Rejected';
                break;
        }
        return view('admin.submission.edit', compact('submmission', 'approveName'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Submmission $submmission)
    {
        if ($request->approve == 1) {
            $submmission->approve = 1;
            $submmission->approve_at = now();
            $submmission->approve_by = Auth::user()->name;
            $message = 'Pengajuan Berhasil Diapprove';
        } else if ($request->approve == 2) {
            $submmission->approve = 2;
            $submmission->reject_at = now();
            $submmission->reject_by = Auth::user()->name;
            $message = 'Pengajuan Berhasil Direject';
        }

        $submmission->save();

        notyf()
            ->position('x', 'center')
            ->position('y', 'top')
            ->addSuccess($message);
        return redirect()->route('admin.submission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submmission $submmission)
    {
        //
    }
}
