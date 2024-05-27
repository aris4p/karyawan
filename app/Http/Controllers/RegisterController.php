<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('admin.register.index',[
            'title' => 'Register'
        ]);
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users', // Ganti 'karyawan' dengan nama tabel Anda
            'tgllahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);
        
        $imageName = time().'.'.$request->foto->extension();  
        $request->foto->move(public_path('images'), $imageName);
        
        // Simpan data ke database
        $user = new User;
        $user->name = $validatedData['nama'];
        $user->email = $validatedData['email'];
        $user->tgllahir = $validatedData['tgllahir'];
        $user->alamat = $validatedData['alamat'];
        $user->password = bcrypt($validatedData['password']);
        $user->foto = $imageName;
        $user->status = $validatedData['status'];
        $user->save();
        
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
