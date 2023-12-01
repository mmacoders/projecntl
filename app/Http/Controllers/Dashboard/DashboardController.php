<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(Employee $employee) {
        $today = date('Y-m-d');
        // $employeeId = auth()->user()->id;
        $idEmployee = $employee->id_employee;
        
        $attendance = DB::table('attendances')->where('employee_id', $idEmployee)->where('date_attend', $today)->first();
        
        $historyOfThisMonth = DB::table('attendances')
        ->where('employee_id', $idEmployee)
        ->whereRaw('MONTH(date_attend)="'. date("m"). '"')
        ->whereRaw('YEAR(date_attend)="' . date("Y") . '"')
        ->orderBy('date_attend')->get();

        $rekapAttendance = DB::table('attendances')
        ->selectRaw('COUNT(employee_id) as jmlh_hadir, SUM(IF(check_in > "07:00", 1, 0)) as jmlh_terlambat')
        ->where('employee_id', $idEmployee)
        ->whereRaw('MONTH(date_attend)="'. date("m"). '"')
        ->whereRaw('YEAR(date_attend)="' . date("Y") . '"')
        ->first();

        $leaderboard = DB::table('attendances')
        ->join('employees', 'attendances.employee_id', '=', 'employees.id_employee')
        ->where('date_attend', $today)
        ->get();

        $rekapIzin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="izin", 1, 0)) as jmlh_izin, SUM(IF(status="sakit", 1, 0)) as jmlh_sakit')
        ->whereRaw('MONTH(tgl_izin)="' . date('m') . '"')
        ->whereRaw('YEAR(tgl_izin)="' . date("Y") . '"')
        ->where('status_approved', 1)
        ->where('employee_id', $idEmployee)
        ->first();

        return view('dashboard.index',compact('attendance', 'historyOfThisMonth', 'rekapAttendance', 'leaderboard', 'rekapIzin'));
    }
}
