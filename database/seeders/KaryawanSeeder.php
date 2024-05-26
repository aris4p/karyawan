<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
         $users = [
            [
                'name' => 'Bayu Satrio',
                'email' => 'bayusatrio@example.com',
                'password' => Hash::make('password'),
                'tgllahir' => '1990-01-01', // Tanggal lahir contoh
                'alamat' => 'Alamat contoh',
                'foto' => 'admin.jpg', // Nama file foto contoh
                'status' => 1, // Menggunakan nilai enum 1 untuk admin
            ],
            [
                'name' => 'Marcella',
                'email' => 'marcella@example.com',
                'password' => Hash::make('password'),
                'tgllahir' => '1995-05-05', // Tanggal lahir contoh
                'alamat' => 'Alamat contoh',
                'foto' => 'user.jpg', // Nama file foto contoh
                'status' => 2, // Menggunakan nilai enum 2 untuk user
            ],
       
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
