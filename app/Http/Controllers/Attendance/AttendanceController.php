<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    //
    public function create() {
        $today = date('Y-m-d');
        $isAttend = DB::table('attendances')->where('date_attend', $today)->count();
        return view('attendance.index', compact('isAttend'));
    }

    public function store(Request $request, Employee $employee) {
        
        // $employeeId = auth()->user()->id;
        $idEmployee = $employee->id_employee;
        $dateAttend = date('Y-m-d');
        $hour = date('H:i:s');

        $isAttend = DB::table('attendances')->where('date_attend', $dateAttend)->where('employee_id', '001')->count();

        if($isAttend > 0) {
            $note = 'out';
        } else {
            $note = 'in';
        }

        $image = $request->img;
        $location = $request->loc;
        
        $folderPath = 'public/uploads/presence/';
        
        $imageParts = explode(';base64', $image);
        $imageBase64 = base64_decode($imageParts[1]);
        
        $fileName = $dateAttend . '-' . $note . '.png';
        $file = $folderPath . $fileName;


        if($isAttend > 0) {
            $checkOut = [
                'check_out' => $hour,
                'photo_out' => $fileName,
                'location_out' => $location,
            ];
            $update = DB::table('attendances')->where('attend_date', $dateAttend)->where('employee_id', '001')->update($checkOut);

            if($update) {
                echo 'success|Anda telah melakukan absensi pulang';
                Storage::put($file, $imageBase64);
            } else  {
                echo 'error|Anda gagal melakukan absensi pulang';
            }
        } else {
            $checkIn = [
                'check_in' => $hour,
                'photo_in' => $fileName,
                'location_in' => $location,
                'date_attend' => $dateAttend,
                'employee_id' => '001',
            ];
    
            $save = DB::table('attendances')->insert($checkIn);

            if($save) {
                echo 'success|Anda telah berhasil melakukan absensi masuk';
                Storage::put($file, $imageBase64);
            } else {
                echo 'error|Anda gagal melakukan absensi masuk';
            }
        } 
        
    }
}
