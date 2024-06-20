<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStudentRequest;
use App\Http\Requests\Admin\AdminStudentUpdateRequest;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AdminStudentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::with('classroom')->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_edit = '<a href="' . route('admin.student.edit', $row->nik) . '" class="btn btn-sm btn-icon item-edit"><i class="text-info ti ti-eye"></i></a>';
                    $btn_view = '<a href="' . route('admin.student.show', $row->nik) . '" class="btn btn-sm btn-icon item-view"><i class="text-warning ti ti-pencil"></i></a>';
                    $btn_delete = '<button class="btn btn-sm btn-icon item-delete" data-nik="' . $row->nik . '"><i class="text-danger ti ti-trash"></i></button>';
                    return '<div class="btn-group">' . $btn_view . $btn_edit . $btn_delete . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.student.index');
    }

    public function list()
    {
        $students = Student::with('classroom')->latest()->get();

        return response()->json([
            'success'   => true,
            'data'      => $students
        ]);
    }

    public function create()
    {
        $classrooms = Classroom::latest()->get();

        return view('admin.student.create', compact('classrooms'));
    }

    public function store(AdminStudentRequest $request)
    {
        $student = Student::where('nik', $request->nik)->first();

        if ($student) {
            notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addError('NIK Telah Terdaftar');
            return redirect()->back()->withInput();
        }

        if ($request->hasFile('photo')) {
            $photo = $request->nik . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = 'public/uploads/students/';
            $request->file('photo')->storeAs($path, $photo);
        } else {
            $photo = $request->photo;
        }

        Student::create([
            'name'          => $request->name,
            'nik'           => $request->nik,
            'classroom_id'  => $request->classroom_id,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'photo'         => $photo,
            'password'      => Hash::make($request->password)
        ]);

        notyf()
            ->position('x', 'center')
            ->position('y', 'top')
            ->addSuccess('Siswa Berhasil Ditambahkan');
        return redirect()->route('admin.student.index');
    }

    public function show(Student $student)
    {
        $classrooms = Classroom::get();

        return view('admin.student.view', compact('student', 'classrooms'));
    }

    public function edit(Student $student)
    {
        $classrooms = Classroom::get();
        return view('admin.student.edit', compact('student', 'classrooms'));
    }

    public function update(AdminStudentUpdateRequest $request, Student $student)
    {
        if ($request->hasFile('photo')) {
            if ($student->photo) {
                Storage::delete('public/uploads/students/' . $student->photo);
            }

            $photo = $request->nik . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = 'public/uploads/students/';
            $request->file('photo')->storeAs($path, $photo);
        } else {
            $photo = $student->photo;
        }

        if ($request->password) {
            $data = [
                'name'          => $request->name,
                'nik'           => $request->nik,
                'classroom_id'  => $request->classroom_id,
                'phone'         => $request->phone,
                'address'       => $request->address,
                'photo'         => $photo,
                'password'      => Hash::make($request->password)
            ];
        } else {
            $data = [
                'name'          => $request->name,
                'nik'           => $request->nik,
                'classroom_id'  => $request->classroom_id,
                'phone'         => $request->phone,
                'address'       => $request->address,
                'photo'         => $photo,
            ];
        }

        $student->update($data);

        notyf()
            ->position('x', 'center')
            ->position('y', 'top')
            ->addSuccess('Siswa Berhasil Diubah');
        return redirect()->route('admin.student.index');
    }

    public function destroy(Student $student)
    {
        if ($student->photo) {
            Storage::delete('public/uploads/students/' . $student->photo);
        }

        $student->delete();
    }
}
