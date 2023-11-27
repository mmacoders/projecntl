<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IzinController extends Controller
{
    //
    public function index() {
        $dataIzin = DB::table('pengajuan_izin')
        ->where('user_id', 2)
        ->get();

        return view('pengajuan.izin.index', compact('dataIzin'));
    }

    public function create() {
        $dataIzin = DB::table('pengajuan_izin')
        ->where('user_id', 2)
        ->get();

        return view('pengajuan.izin.create');
    }

    public function store(Request $request) {
        $tglIzin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'user_id' => 2,
            'tgl_izin' => $tglIzin,
            'status' => $status,
            'keterangan' => $keterangan,
        ];

        $save = DB::table('pengajuan_izin')->insert($data);

        if($save) {
            return redirect()->route('pengajuan-izin')->with(['success' => 'Data berhasil disimpan']);
        } else {
            return redirect()->route('pengajuan-izin')->with(['error' => 'Data gagal disimpan']);
        }
    }
}
