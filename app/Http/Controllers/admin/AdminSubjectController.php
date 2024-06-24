<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSubjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Subject::latest())
                ->addColumn('action', function ($row) {
                    $btn_edit = '<button class="btn btn-sm btn-icon item-edit" data-id="' . $row->id . '"><i class="text-warning ti ti-pencil"></i></button>';
                    $btn_delete = '<button class="btn btn-sm btn-icon item-delete" data-id="' . $row->id . '"><i class="text-danger ti ti-trash"></i></button>';
                    return '<div class="btn-group">' . $btn_edit . $btn_delete . '</div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.subjects.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        try {
            Subject::create([
                'name'      => $request->name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditambahkan'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Terdapat Error, Silahkan Coba Kembali: ' . $th->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            Subject::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Terdapat Error, Silahkan Coba Kembali: ' . $th->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return response()->json($subject);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update(['name' => $request->name]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diubah'
        ]);
    }
}
