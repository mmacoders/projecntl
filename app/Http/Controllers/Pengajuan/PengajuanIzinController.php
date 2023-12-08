<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengajuanIzinController extends Controller
{
    //
    public function index() {
        $idEmployee = Auth::guard('employee')->user()->id_employee;
        
        $dataIzin = DB::table('pengajuan_izin')
        ->where('employee_id', $idEmployee)
        ->get();

        return view('pengajuan-izin.index', compact('dataIzin'));
    }

    public function create() {
        return view('pengajuan-izin.create');
    }

    public function store(Request $request) {
        $idEmployee = Auth::guard('employee')->user()->id_employee;
        $izinAt = $request->izinAt;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'izin_at' => $izinAt,
            'status' => $status,
            'keterangan' => $keterangan,
            'employee_id' => $idEmployee,
        ];

        $save = DB::table('pengajuan_izin')->insert($data);

        if($save) {
            return redirect()->route('pengajuan-izin')->with(['success' => 'Data berhasil disimpan']);
        } else {
            return redirect()->route('pengajuan-izin')->with(['error' => 'Data gagal disimpan']);
        }
    }

    public function cekPengajuanIzin(Request $request) {
        $izinAt = $request->izinAt;
        $idEmployee = Auth::guard('employee')->user()->id_employee;

        $cek = DB::table('pengajuan_izin')
        ->where('employee_id', $idEmployee)
        ->where('izin_at', $izinAt)
        ->count();

        return $cek;
    }
}
