<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;


class DatabaseSeeder extends Seeder
{
  

    public function run(): void
    {
        $this->call([
            JenisUserSeeder::class,
            UserSeeder::class,
            MenuLevelSeeder::class,
            MenuSeeder::class,
            MessageSeeder::class,
        ]);
    }
}
