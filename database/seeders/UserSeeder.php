<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $test = "qwe123";
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make($test),
                'id_jenis_user' => 1, // Relasi ke jenis_user admin
                'no_hp' => '08123456789',
                'pin' => '1234',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular Mhs',
                'email' => 'mhs@example.com',
                'password' => Hash::make($test),
                'id_jenis_user' => 2, // Relasi ke jenis_user user
                'no_hp' => '08123456789',
                'pin' => '5678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular Dosen',
                'email' => 'dosen@example.com',
                'password' => Hash::make($test),
                'id_jenis_user' => 3, // Relasi ke jenis_user user
                'no_hp' => '08123456789',
                'pin' => '5678',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
