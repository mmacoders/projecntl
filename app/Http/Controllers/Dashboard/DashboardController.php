<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index() {
        $today = date('Y-m-d');
        // $employeeId = auth()->user()->id;
        
        $attendance = DB::table('attendances')->where('user_id', 2)->where('attend_date', $today)->first();
        
        $historyOfThisMonth = DB::table('attendances')
        ->where('user_id', 2)
        ->whereRaw('MONTH(attend_date)="'. date("m"). '"')
        ->whereRaw('YEAR(attend_date)="' . date("Y") . '"')
        ->orderBy('attend_date')->get();

        $rekapAttendance = DB::table('attendances')
        ->selectRaw('COUNT(user_id) as jmlh_hadir, SUM(IF(check_in > "07:00", 1, 0)) as jmlh_terlambat')
        ->where('user_id', 2)
        ->whereRaw('MONTH(attend_date)="'. date("m"). '"')
        ->whereRaw('YEAR(attend_date)="' . date("Y") . '"')
        ->first();

        $leaderboard = DB::table('attendances')
        ->join('users', 'attendances.user_id', '=', 'users.id')
        ->where('attend_date', $today)
        ->get();

        $rekapIzin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="izin", 1, 0)) as jmlh_izin, SUM(IF(status="sakit", 1, 0)) as jmlh_sakit')
        ->whereRaw('MONTH(tgl_izin)="' . date('m') . '"')
        ->whereRaw('YEAR(tgl_izin)="' . date("Y") . '"')
        ->where('status_approved', 1)
        ->where('user_id', 2)
        ->first();

        return view('dashboard.index',compact('attendance', 'historyOfThisMonth', 'rekapAttendance', 'leaderboard', 'rekapIzin'));
    }
}
