<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    //
    public function create() {
        $today = date('Y-m-d');
        $isAttend = DB::table('attendances')->where('attend_date', $today)->count();
        return view('attendance.index', compact('isAttend'));
    }

    public function store(Request $request) {
        
        $employeeId = auth()->user()->id;
        $attendDate = date('Y-m-d');
        $hour = date('H:i:s');

        $isAttend = DB::table('attendances')->where('attend_date', $attendDate)->where('user_id', $employeeId)->count();

        if($isAttend) {
            $note = 'out';
        } else {
            $note = 'in';
        }

        $location = $request->location;
        $image = $request->image;
        
        $folderPath = 'public/uploads/absensi';
        $formatName = $attendDate. '-'. $note;
        
        $imageParts = explode(';base64', $image);
        $imageBase64 = base64_decode($imageParts[1]);
        
        $fileName = $formatName . '.png';
        $file = $folderPath . $fileName;


        if($isAttend > 0) {
            $checkOut = [
                'check_out' => $hour,
                'photo_out' => $fileName,
                'location_out' => $location,
            ];
            $update = DB::table('attendances')->where('attend_date', $attendDate)->where('user_id', $employeeId)->update($checkOut);

            if($update) {
                echo 'success|Anda telah melakukan absensi pulang';
                Storage::put($file, $imageBase64);
            } else  {
                echo 'error|Anda gagal melakukan absensi pulang';
            }
        } else {
            $checkIn = [
                'user_id' => $employeeId,
                'attend_date' => $attendDate,
                'check_in' => $hour,
                'photo_in' => $fileName,
                'location_in' => $location,
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
