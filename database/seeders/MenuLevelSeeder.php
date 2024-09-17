<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        DB::table('menu_level')->insert([
            [
            'level'=>'Admin'
            ],
            [
            'level'=>'Mahasiswa'
            ],
            [
            'level'=>'Dosen'
            ]
        ]);
    }
}
