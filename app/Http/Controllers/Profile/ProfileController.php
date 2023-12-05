<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function edit() {
        $idEmployee = Auth::guard('employee')->user()->id_employee;

        $employee = DB::table('employees')
        ->where('id_employee', $idEmployee)
        ->first();

        return view('profile.edit', compact('employee'));
    }

    public function update(Request $request) {
        $idEmployee = Auth::guard('employee')->user()->id_employee;
        $fullname = $request->fullname;
        $password = Hash::make($request->password);

        $employee = DB::table('employees')
        ->where('id_employee', $idEmployee)
        ->first();

        if($request->hasFile('photo')) {
            $photo = $idEmployee . "." . $request->file('photo')->getClientOriginalExtension();
        } else {
            $photo = $employee->photo;
        }
        
        if(empty($request->password)) {
            $data = [
                'fullname' => $fullname,
                'photo'=> $photo
            ];
        } else {
            $data = [
                'fullname' => $fullname,
                'password' => $password,
                'photo' => $photo
            ];
        }

        $update = DB::table('employees')
        ->where('id_employee', $idEmployee)
        ->update($data);

        if($update) {
            if($request->hasFile('photo')) {
                $folderPath = 'public/uploads/employee/';
                $request->file('photo')->storeAs($folderPath, $photo);
            }

            return redirect()->back()->with('success', 'Data berhasil di perbarui');
        } else {
            return redirect()->back()->with('error', 'Data gagal di perbarui');
        }
    }
}
