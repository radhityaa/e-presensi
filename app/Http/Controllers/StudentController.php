<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $nik = Auth::guard('student')->user()->nik;
        $student = Student::where('nik', $nik)->first();

        return view('student.index', compact('student'));
    }

    public function update(Request $request, $nik)
    {
        $student = Student::where('nik', $nik)->first();

        if ($request->hasFile('photo')) {
            $photo = $nik . '.' . $request->file('photo')->getClientOriginalExtension();
        } else {
            $photo = $student->photo;
        }

        if (!empty($request->password)) {
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'photo' => $photo,
                'password' => Hash::make($request->password),
            ];
        } else {
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'photo' => $photo,
            ];
        }

        $update = $student->update($data);

        if ($update) {
            if ($request->hasFile('photo')) {
                $path = 'public/uploads/students/';
                $request->file('photo')->storeAs($path, $photo);
            }

            return redirect()->back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return redirect()->back()->with(['error' => 'Data Gagal Diubah']);
        }
    }
}
