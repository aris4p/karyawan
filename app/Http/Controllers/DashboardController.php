<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $karyawan = User::count();
        return view('admin.dashboard',[
            'title' => "Dashboard"
        ],compact('karyawan'));
    }
}
