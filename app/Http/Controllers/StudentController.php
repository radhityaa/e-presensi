<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $nik = Auth::guard('student')->user()->nik;
        $student = Student::where('nik', $nik)->first();

        return view('settings.information', compact('student'));
    }

    public function update(Request $request, $nik)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

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
    public function changePassword()
    {
        return view('settings.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'current_password' => 'required|string|min:8'
        ]);

        $student = Student::where('nik', Auth::guard('student')->user()->nik)->first();

        if (Hash::check($request->current_password, $student->password)) {
            $student->update([
                'password' =>  Hash::make($request->password)
            ]);

            notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addSuccess('Password Berhasil Diubah');

            Auth::guard('student')->logout();
            return redirect(route('auth.login.index'));
        } else {
            notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addError('Password Lama Salah');
            return redirect()->back();
        }
    }

    public function changePicture()
    {
        return view('settings.change-picture');
    }

    public function updatePicture(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $student = Student::where('nik', Auth::guard('student')->user()->nik)->first();

        if ($student->photo) {
            Storage::delete('public/uploads/students/' . $student->photo);
        }

        if ($request->hasFile('photo')) {
            $photo = $student->nik . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = 'public/uploads/students/';
            $request->file('photo')->storeAs($path, $photo);
        } else {
            $photo = $request->photo;
        }

        $student->update([
            'photo' => $photo
        ]);

        notyf()
            ->position('x', 'center')
            ->position('y', 'top')
            ->addSuccess('Foto Berhasil Diubah');
        return redirect()->back();
    }
}
