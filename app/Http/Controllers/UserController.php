<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin|staff'])->except(['index']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    switch ($row->status) {
                        case 1:
                            return '<span class="badge bg-success">Aktif</span>';
                            break;
                        case 2:
                            return '<span class="badge bg-danger">Tidak Aktif</span>';
                            break;
                        default:
                            return '<span class="badge bg-warning">Pending</span>';
                            break;
                    }
                })
                ->addColumn('action', function ($row) {
                    if (Auth::user()->hasRole('admin|staff')) {
                        $btn_edit = '<a href="' . route('admin.users.edit', $row->nik) . '" class="btn btn-sm btn-icon item-view"><i class="text-warning ti ti-pencil"></i></a>';
                        $btn_delete = '<button class="btn btn-sm btn-icon item-delete" data-nik="' . $row->nik . '"><i class="text-danger ti ti-trash"></i></button>';
                        $btn_approve = '<button class="btn btn-sm btn-icon item-approve" data-nik="' . $row->nik . '"><i class="text-success ti ti-circle-check"></i></button>';
                        $btn_reject = '<button class="btn btn-sm btn-icon item-reject" data-nik="' . $row->nik . '"><i class="text-danger ti ti-circle-x"></i></button>';

                        if ($row->status === 0 || $row->status === 2) {
                            return '<div class="btn-group">' . $btn_approve . $btn_edit . $btn_delete  . '</div>';
                        } else if ($row->status === 1) {
                            return '<div class="btn-group">' . $btn_reject . $btn_edit . $btn_delete  . '</div>';
                        }

                        return '<div class="btn-group">' . $btn_edit . $btn_delete . '</div>';
                    } else {
                        return '';
                    }
                })
                ->rawColumns(['status', 'action'])
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
            'status'        => $request->status,
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
                'status'         => $request->status,
                'password'      => Hash::make($request->password)
            ];
        } else {
            $data = [
                'name'          => $request->name,
                'nik'           => $request->nik,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'status'         => $request->status,
            ];
        }

        $user->update($data);

        $role = Role::find($request->role);
        $user->syncRoles($role);

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

    public function status(Request $request)
    {
        $user = User::where('nik', $request->nik)->first();
        $user->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status Berhasil ' . ($request->status == 1 ? 'Diaktifkan' : 'DiTidak Aktifkan')
        ]);
    }
}
