<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;

class AdminClassroomController extends Controller
{
    public function index()
    {
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
