<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class AdminClassroomController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:admin|staff'])->except(['index', 'list', 'show']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $classrooms = Classroom::with('user')->latest()->get();

            return DataTables::of($classrooms)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_edit = '<a href="' . route('admin.classroom.edit', $row->id) . '" class="btn btn-sm btn-icon item-view"><i class="text-warning ti ti-pencil"></i></a>';
                    $btn_delete = '<button class="btn btn-sm btn-icon item-delete" data-id="' . $row->id . '" data-name="' . $row->name . '"><i class="text-danger ti ti-trash"></i></button>';

                    if (Auth::user()->hasRole('admin|staff')) {
                        return '<div class="btn-group">' . $btn_edit . $btn_delete . '</div>';
                    }
                    return '<div class="btn-group"></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.classroom.index');
    }

    public function list()
    {
        $classrooms = Classroom::with('user')->latest()->get();

        return response()->json([
            'success'   => true,
            'data'      => $classrooms
        ]);
    }

    public function create()
    {
        $users = User::latest()->get();

        return view('admin.classroom.create', compact('users'));
    }

    public function store(Request $request)
    {
        Classroom::create([
            'name'      => $request->name,
            'user_id'   => $request->user_id
        ]);

        notyf()
            ->position('x', 'center')
            ->position('y', 'top')
            ->addSuccess('Kelas Berhasil Ditambahkan');
        return redirect()->route('admin.classroom.index');
    }

    public function show(Classroom $classroom)
    {
        $users = User::latest()->get();

        return view('admin.classroom.view', compact('classroom', 'users'));
    }

    public function edit(Classroom $classroom)
    {
        $users = User::latest()->get();

        return view('admin.classroom.edit', compact('users', 'classroom'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $classroom->update($request->all());

        notyf()
            ->position('x', 'center')
            ->position('y', 'top')
            ->addSuccess('kelas Berhasil Diubah');
        return redirect()->route('admin.classroom.index');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
    }
}
