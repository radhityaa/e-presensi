<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn_edit = '<a href="' . route('admin.users.edit', $row->nik) . '" class="btn btn-sm btn-icon item-view"><i class="text-warning ti ti-pencil"></i></a>';
                    $btn_delete = '<button class="btn btn-sm btn-icon item-delete" data-nik="' . $row->nik . '"><i class="text-danger ti ti-trash"></i></button>';
                    return '<div class="btn-group">' . $btn_edit . $btn_delete . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function store(UserRequest $request)
    {
        $data = [
            'name'          => $request->name,
            'nik'           => $request->nik,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      =>  Hash::make($request->password)
        ];

        $user = User::create($data);

        // assign Role
        $role = Role::find($request->role);
        $user->assignRole($role);

        notyf()
            ->position('x', 'center')
            ->position('y', 'top')
            ->addSuccess('User Berhasil Dibuat');
        return redirect()->route('admin.users.index');
    }

    public function edit($nik)
    {
        $user = User::where('nik', $nik)->first();
        return view('admin.users.edit', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function update(Request $request, $nik)
    {
        $user = User::where('nik', $nik)->first();

        if ($request->password) {
            $data = [
                'name'          => $request->name,
                'nik'           => $request->nik,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'password'      => Hash::make($request->password)
            ];
        } else {
            $data = [
                'name'          => $request->name,
                'nik'           => $request->nik,
                'email'         => $request->email,
                'phone'         => $request->phone,
            ];
        }

        $user->update($data);

        notyf()
            ->position('x', 'center')
            ->position('y', 'top')
            ->addSuccess('User Berhasil Diubah');
        return redirect()->route('admin.users.index');
    }

    public function destroy($nik)
    {
        return User::where('nik', $nik)->delete();
    }
}
