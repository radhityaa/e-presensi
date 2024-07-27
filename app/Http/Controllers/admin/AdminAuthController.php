<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::guard('user')->attempt(['nik' => $request->nik, 'password' => $request->password])) {
            if (Auth::guard('user')->user()->status === 0) {
                notyf()
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->addError('Akun Belum Aktif');
                return redirect(route('admin.login.index'));
            } else if (Auth::guard('user')->user()->status === 2) {
                notyf()
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->addError('Akun Tidak Aktif');
                return redirect(route('admin.login.index'));
            } else if (Auth::guard('user')->user()->status === 1) {
                return redirect(route('admin.dashboard'));
            }
        } else {
            notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addError('Nik / Password Salah.');
            return redirect(route('admin.login.index'));
        }
    }

    public function logout()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect(route('welcome.index'));
        }
    }
}
