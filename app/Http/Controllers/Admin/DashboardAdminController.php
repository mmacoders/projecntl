<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    //
    public function index() {
        $today = date('Y-m-d');
        $rekapAttendance = DB::table('attendances')
        ->selectRaw('COUNT(user_id) as jmlh_hadir, SUM(IF(check_in > "07:00", 1, 0)) as jmlh_terlambat')
        ->where('attend_date', $today)
        ->first();

        $rekapIzin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="izin", 1, 0)) as jmlh_izin, SUM(IF(status="sakit", 1, 0)) as jmlh_sakit')
        ->where('tgl_izin', $today)
        ->where('status_approved', 1)
        ->first();


        return view('admin.dashboard.index', compact('rekapAttendance', 'rekapIzin'));
    }
}
