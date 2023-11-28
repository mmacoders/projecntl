<?php

namespace App\Http\Controllers\History;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    //
    public function index() {
        $months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('history.index', compact('months'));
    }

    public function search(Request $request) {
        $month = $request->month;
        $year = $request->year;
        $employeeId = auth()->user()->id;

        $history = DB::table('attendances')
        ->whereRaw('MONTH(attend_date)="'. $month . '"')
        ->whereRaw('YEAR(attend_date)="' . $year . '"')
        ->where('user_id', $employeeId)
        ->orderBy('attend_date')
        ->get();

        return view('history.show', compact('history'));
    }
}
