<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttendaceController extends Controller
{
    //
    public function index() {
        return view('attendance.index');
    }

    public function store(Request $request) {
        $tgl_presensi = date('Y-m-d');
        $location = $request->lokasi;
        $image = $request->gambar;
        $folderPath = "public/uploads/absensi";
        $formatName = $tgl_presensi;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);

    }
}
