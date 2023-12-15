<?php

namespace App\Http\Controllers\Presence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PresenceController extends Controller
{
    //
    public function create() {
        $idEmployee = Auth::guard('employee')->user()->id_employee;
        $checkIsPresence = DB::table('presences')
        ->where('presence_at', date('Y-m-d'))
        ->where('employee_id', $idEmployee)
        ->count();

        return view('presence.create', compact('checkIsPresence'));
    }

    public function store(Request $request) {

        $idEmployee = Auth::guard('employee')->user()->id_employee;

        $presenceAt = date('Y-m-d');
        $presenceHour = date('H:i:s');

        $image = $request->image;
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $checkIsPresence = DB::table('presences')
        ->where('presence_at', $presenceAt)
        ->where('employee_id', $idEmployee)
        ->count();

        if($checkIsPresence > 0) {
            $note = 'out'; 
        } else {
            $note = 'in';
        }

        $folderPath = 'public/uploads/presence/';
        $imageParts = explode(';base64', $image);
        $decodeImage = base64_decode($imageParts[1]);

        $formatName = $idEmployee . "-" . $presenceAt . '-' . $note;
        $fileName = $formatName . '.png';
        $file = $folderPath . $fileName;

        if($checkIsPresence > 0) {
            $dataCheckOut = [
                'check_out' => $presenceHour,
                'photo_out' => $fileName,
                'latitude' => $latitude,
                'longitude' => $longitude
            ];
            $update = DB::table('presences')
            ->where('presence_at', $presenceAt)
            ->where('employee_id', $idEmployee)
            ->update($dataCheckOut);

            if ($update) {
                echo 'success|Berhasil melakukan absensi pulang';
                Storage::put($file, $decodeImage);
            } else {
                echo 'error|gagal melakukan absensi pulang, Silahkan hubungi admin';
            }
        } else  {
            $dataCheckIn = [
                'check_in' => $presenceHour,
                'photo_in' => $fileName,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'presence_at' => $presenceAt,
                'employee_id' => $idEmployee,
            ];
    
            $save = DB::table('presences')->insert($dataCheckIn);
    
            if($save) {
                echo 'success|Berhasil melakukan absensi masuk';
                Storage::put($file, $decodeImage);
            } else {
                echo 'error|Gagal melakukan absensi masuk, Silahkan hubungi admin';
            }
        }
    }
    public function export()
    {
        // Ambil data dari database
        // $data = \App\Models\presences::whereDate('check_in', '>=', now())
        //     ->whereDate('check_out', '<=', now())
        //     ->get();

            $data = DB::table('presences')
            ->where('presence_at', $presenceAt)
            ->where('employee_id', $idEmployee)
            ->whereDate('check_in', '>=', now())
            ->whereDate('check_out', '<=', now())
            ->get();

        // Buat instance dari Excel
        $excel = Excel::create('Data Kehadiran', function($excel) use ($data) {

            // Set header untuk file excel
            $excel->sheet('Data Kehadiran', function($sheet) use ($data) {
                $sheet->setHeader(['ID', 'Check In', 'Check Out', 'Tanggal Sekarang']);

                // Set data untuk file excel
                foreach ($data as $attendance) {
                    $sheet->appendRow([
                        $attendance->id,
                        $attendance->check_in,
                        $attendance->check_out,
                        now(),
                    ]);
                }
            });
        });

        // Download file excel
        return $excel->download('xlsx');
    }
}
