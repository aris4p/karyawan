<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
                $editBtn = '<a href="javascript:void(0)" class="editBtn btn btn-primary btn-sm" id="editbtn" data-id="'.$row->id.'">Edit</a>';
                $deleteBtn = '<a href="javascript:void(0)" class="deleteBtn btn btn-danger btn-sm" id="btnHapusKaryawan" data-id="'.$row->id.'">Delete</a>';
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
            ->addColumn('tgllahir', function($data) {
                $tgllahir = Carbon::parse($data->tgllahir);
                // $usia =  floor($data->tgllahir);
                $usia = floor($tgllahir->diffInYears(Carbon::now()));
                
                return $tgllahir->format('Y-m-d') . '<br>'. '('. $usia . ' Tahun'.')';
            })
            ->rawColumns(['action','foto','tgllahir'])
            ->make(true);
            
        }
        
        return view('admin.karyawan.index',[
            'title' => "Karyawan"
        ]);
    }
    
    public function simpan(Request $request)
    {
        // dd(gettype($request->status));
        // Validasi request jika diperlukan
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users', // Ganti 'karyawan' dengan nama tabel Anda
            'dob' => 'required|date',
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
        $user->tgllahir = $validatedData['dob'];
        $user->alamat = $validatedData['alamat'];
        $user->password = bcrypt($validatedData['password']);
        $user->foto = $imageName;
        $user->status = $validatedData['status'];
        $user->save();
        
        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }
    
    public function getKaryawan($id){
        
        $karyawan = User::find($id);
        
        return response()->json([
            'message' => "Berhasil ambil data",
            'data' => $karyawan
        ]);
        
    }
    
    public function update(Request $request, $id){
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'tgllahir' => 'required|date',
            'alamat' => 'required',
            'status' => 'required'
        ]);
        
        $karyawan = User::findOrFail($id);
        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // Anda dapat menambahkan validasi lain untuk data lainnya di sini
            ]);
            // Hapus foto lama jika ada
            if ($karyawan->foto) {
                $fotoPath = public_path('images') . '/' . $karyawan->foto;
                if (file_exists($fotoPath)) {
                    unlink($fotoPath);
                }
            }
            
            // Simpan foto baru
            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
            
            
      
            $karyawan->name = $request->name;
            $karyawan->email = $request->email;
            $karyawan->tgllahir = $request->tgllahir;
            $karyawan->alamat = $request->alamat;
            $karyawan->status = $request->status;
            $karyawan->foto = $imageName;
            $karyawan->save();
            
        }else{
            
            $karyawan->name = $request->name;
            $karyawan->email = $request->email;
            $karyawan->tgllahir = $request->tgllahir;
            $karyawan->alamat = $request->alamat;
            $karyawan->status = $request->status;

            $karyawan->save();
        }
        
        
        return response()->json([
            'success' => "Berhasil Update Data",
        ]);
        
        
    }

    public function delete(Request $request, $id) {
        // Temukan karyawan berdasarkan ID
        $karyawan = User::find($id);

        if ($karyawan) {
            // Hapus karyawan jika ditemukan
            $karyawan->delete();
            
            // Memberikan respons JSON yang menandakan penghapusan berhasil
            return response()->json(['success' => true]);
        } else {
            // Memberikan respons JSON yang menandakan karyawan tidak ditemukan
            return response()->json(['success' => false]);
        }
    }
    
    
}
