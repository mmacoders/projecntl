<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index() {
        $today = date('Y-m-d');
        $employeeId = auth()->user()->id;
        $attendance = DB::table('attendances')->where('user_id', $employeeId)->where('attend_date', $today)->first();
        return view('dashboard.index', compact('attendance'));
    }
}
