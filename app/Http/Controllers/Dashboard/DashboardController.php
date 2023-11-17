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
        $employeeId = auth()->user()->id;
        $attendance = DB::table('attendances')->where('user_id', $employeeId)->where('attend_date', $today)->first();
        $historyOfThisMonth = DB::table('attendances')->whereRaw('MONTH(attend_date)="'. date("m"). '"')
        ->whereRaw('YEAR(attend_date)="' . date("Y") . '"')
        ->orderBy('attend_date')->get();
        return view('dashboard.index', compact('attendance', 'historyOfThisMonth'));
    }
}
