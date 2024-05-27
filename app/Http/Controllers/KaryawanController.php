<?php

namespace App\Http\Controllers;

use App\Models\User;
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

                    $editBtn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                    $deleteBtn = '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                
                    return $editBtn . ' ' . $deleteBtn;
            })
            ->addColumn('status', function($row){
                if($row->status == 1) {
                    return 'Menikah';
                } else {
                    return 'Belum Menikah';
                }
            })
            ->addColumn('foto', function($data) {
                return '<img src="/images/' . $data->foto . '" width="100" height="100">';
            })
            ->rawColumns(['action','foto'])
            ->make(true);

        }

        return view('admin.karyawan.index',[
            'title' => "Karyawan"
        ]);
    }

    public function simpan(Request $request)
    {
        // Validasi request jika diperlukan
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users', // Ganti 'karyawan' dengan nama tabel Anda
            'dob' => 'required|date',
            'alamat' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $imageName = time().'.'.$request->foto->extension();  
        $request->foto->move(public_path('images'), $imageName);

        // Simpan data ke database
        $user = new User;
        $user->name = $validatedData['nama'];
        $user->email = $validatedData['email'];
        $user->tgllahir = $validatedData['dob'];
        $user->alamat = $validatedData['alamat'];
        $user->password = bcrypt($validatedData['password']);
        $user->foto = $imageName;
        $user->status = $validatedData['status'];
        $user->save();

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }


}
