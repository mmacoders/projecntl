<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeAdminController extends Controller
{
    //
    public function index(Request $request) {
        $query = Employee::query();
        $query->select('employees.*');
        $query->where('role', 'user');
        $query->orderBy('fullname');

        if(!empty($request->fullname)) {
            $query->where('fullname', 'like', '%' . $request->fullname . '%');
        }

        $employee = $query->paginate(10);

        return view('admin.employee.index', compact('employee'));
    }

    public function store(Request $request) {
        $username = $request->username;
        $password = Hash::make('12345678');
        $fullname = $request->fullname;
        $position = $request->position;
        $tipemagang = $request->tipemagang;
        $gender = $request->gender;

        try {
            // Cek apakah ada file yang diupload
            if ($request->hasFile('photo')) {
                // Validasi file dan berikan nama unik dengan timestamp
                $photo = now()->timestamp . '.' . $request->file('photo')->getClientOriginalExtension();
        
                // Simpan file ke direktori yang ditentukan
                $request->file('photo')->storeAs('public/uploads/employee/', $photo);
            } else {
                // Jika tidak ada file diupload, atur $photo menjadi null
                $photo = null;
            }
        
            // Data untuk disimpan ke database
            $data = [
                'username' => $username,
                'password' => $password,
                'fullname' => $fullname,
                'position' => $position,
                'tipemagang' => $tipemagang,
                'gender' => $gender,
                'photo' => $photo,
            ];
        
            // Simpan data ke database
            $save = DB::table('employees')->insert($data);
        
            if ($save) {
                return redirect()->back()->with('success', 'Data karyawan berhasil ditambahkan');
            } else {
                throw new \Exception('Gagal menyimpan data ke database');
            }
        } catch (\Exception $e) {
            // Tangani kesalahan dan tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Data karyawan gagal ditambahkan. ' . $e->getMessage());
        }
    } 


    public function edit(Request $request) {
        $idEmployee = $request->idEmployee;

        $employee = DB::table('employees')
        ->where('id_employee', $idEmployee)
        ->first();

        return view('admin.employee.edit', compact('employee'));
    }

    public function update(Request $request, $idEmployee) {
        $idEmployee = $request->id_employee;
        $username = $request->username;
        $password = Hash::make('12345678');
        $fullname = $request->fullname;
        $position = $request->position;
        $tipemagang = $request->tipemagang;
        $gender = $request->gender;
        $oldPhoto = $request->old_photo;

        if($request->hasFile('photo')) {
            $photo = $idEmployee . "." . $request->file('photo')->getClientOriginalExtension();
        } else {
            $photo = $oldPhoto;
        }

        try {
            $data = [
                'username' => $username,
                'password' => $password,
                'fullname' => $fullname,
                'position' => $position,
                'tipemagang' => $tipemagang,
                'gender' => $gender,
                'photo' => $photo,
            ];

            $update = DB::table('employees')
            ->where('id_employee', $idEmployee)
            ->update($data);

            if($update) {
                if($request->hasFile('photo')) {
                    $folderPath = 'public/uploads/employee/';
                    $folderPathOld = 'public/uploads/employee/';
                    Storage::delete($folderPathOld);
                    $request->file('photo')->storeAs($folderPath, $photo);
                }

                return redirect()->back()->with('success', 'Data karyawan berhasil diperbarui');
            }
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data karyawan gagal diperbarui');
        }
    }

    public function destroy($idEmployee) {
        $delete = DB::table('employees')
        ->where('id_employee', $idEmployee)
        ->delete();

        if($delete) {
            return redirect()->back()->with('success', 'Data karyawan berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data karyawan gagal dihapus');
        }
    }
}
