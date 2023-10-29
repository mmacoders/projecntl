<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request) {
        $credentials = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];

        $success = Auth::guard('employee')->attempt($credentials);

        if($success) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->withErrors(['Invalid credentials']);
        }
    
    }
}
