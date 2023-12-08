<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanIzinKaryawanController extends Controller
{
    //
    public function index() {

        $dataIzin = DB::table('pengajuan_izin')
        ->join('employees', 'pengajuan_izin.employee_id', '=', 'employees.id_employee')
        ->orderBy('izin_at', 'desc')
        ->get();

        return view('admin.pengajuan-izin.index', compact('dataIzin'));
    }

    public function update(Request $request) {
        $statusApproved = $request->status_approved;
        $id = $request->id;

        $update = DB::table('pengajuan_izin')
        ->where('id', $id)
        ->update([
            'status_approved' => $statusApproved
        ]);

        if($update) {
            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Data gagal diperbarui');
        }
    }

    public function updateDecline($id) {
        $update = DB::table('pengajuan_izin')
        ->where('id', $id)
        ->update([
            'status_approved' => 0
        ]);

        if($update) {
            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Data gagal diperbarui');
        }
    }
}
