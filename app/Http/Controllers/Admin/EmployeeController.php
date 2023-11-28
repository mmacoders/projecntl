<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    //
    public function index() {
        $employees = DB::table('employees')
        ->orderBy('fullname')
        ->get();

        return view('admin.employee.index', compact('employees'));
    }
}
