<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        DB::table('jenis_user')->insert([
            ['nama_jenis_user' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jenis_user' => 'mahasiswa', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jenis_user' => 'dosen', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
