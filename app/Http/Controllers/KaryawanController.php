<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KaryawanController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = User::query();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

        }

        return view('admin.karyawan.index',[
            'title' => "Karyawan"
        ]);
    }


}