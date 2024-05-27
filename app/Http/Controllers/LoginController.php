<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }else{
            return view('login');
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Hapus sesi perangkat lain
        Auth::logoutOtherDevices($request->input('password'));
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }
}
