<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu;
use App\Models\MenuLevel;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Create Menu items
        $menu1 = Menu::create([
            'menu_name' => 'Dashboard',
            'menu_link' => 'dashboard',
            'parent_id' => null,
            'menu_icon' => 'icon-grid menu-icon'
        ]);
        
        $menu2 = Menu::create([
            'menu_name' => 'Tambahkan Buku',
            'menu_link' => 'AddBook',
            'parent_id' => null, // or set the correct parent_id if needed
            'menu_icon' => 'icon-columns menu-icon'
        ]);
        
        $menu3 = Menu::create([
            'menu_name' => 'Tambahkan Kategori',
            'menu_link' => 'AddKategori',
            'parent_id' => null, // or set the correct parent_id if needed
            'menu_icon' => 'icon-columns menu-icon'
        ]);
        
        $menu4 = Menu::create([
            'menu_name' => 'Lihat Buku',
            'menu_link' => 'ShowBook',
            'parent_id' => null,
            'menu_icon' => 'icon-bar-graph menu-icon'
        ]);

        // Attach menus to MenuLevel
        $level1 = MenuLevel::find(1);
        $level1->menus()->save($menu1);

        $level2 = MenuLevel::find(2);
        $level2->menus()->save($menu2);
        $level2->menus()->save($menu3);

        $level3 = MenuLevel::find(3);
        $level3->menus()->save($menu4);

        // Get Users
        $user1 = User::find(1); 
        $user2 = User::find(2); 
        $user3 = User::find(3); 

        // Attach menus to Users via setting_menu_user
        if ($user1) {
            $user1->menus()->attach([
                $menu1->id, 
                $menu2->id, 
                $menu3->id, 
                $menu4->id
            ]);
        }
        if ($user2) {
            $user2->menus()->attach([
                $menu1->id,
                $menu2->id
            ]);
        }
        if ($user3) {
            $user3->menus()->attach([
                $menu1->id,
                $menu4->id
            ]);
        }
    }
}
