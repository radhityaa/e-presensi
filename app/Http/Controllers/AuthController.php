<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        if (Auth::guard('student')->attempt(['nik' => $request->nik, 'password' => $request->password])) {
            if (Auth::guard('student')->user()->status === 0) {
                notyf()
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->addError('Akun Belum Aktif.');
                return redirect(route('auth.login.index'));
            } else if (Auth::guard('student')->user()->status === 2) {
                notyf()
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->addError('Akun Tidak Aktif.');
                return redirect(route('auth.login.index'));
            } else if (Auth::guard('student')->user()->status === 1) {
                return redirect(route('dashboard'));
            }
        } else {
            notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addError('Nik / Password Salah.');
            return redirect(route('auth.login.index'));
        }
    }

    public function logout()
    {
        if (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
            return redirect(route('auth.login.index'));
        }
    }

    public function register()
    {
        $classrooms = Classroom::orderBy('name')->get();

        return view('auth.register', compact('classrooms'));
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:students,nik',
            'name' => 'required|string',
            'phone' => 'required|unique:students,phone',
            'address' => 'required',
            'classroom_id' => 'required|exists:classrooms,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            Student::create([
                'name'          => $request->name,
                'nik'           => $request->nik,
                'classroom_id'  => $request->classroom_id,
                'phone'         => $request->phone,
                'address'       => $request->address,
                'status'        => $request->status,
                'password'      => Hash::make($request->password),
                'status'        => 0
            ]);

            DB::commit();
            notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addSuccess('Berhasil Mendaftar, Menunggu Akun DiAktifkan');
            return redirect(route('auth.login.index'));
        } catch (\Throwable $th) {
            DB::rollBack();
            notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addError('Terjadi Kesalahan Server:' . $th->getMessage());
            return redirect(route('auth.login.index'));
        }
    }
}
