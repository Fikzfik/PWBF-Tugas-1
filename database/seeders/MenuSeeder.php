<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuLevel;
use App\Models\JenisUser;

    class MenuSeeder extends Seeder
    {
        public function run(): void
        {
            // Create Menu items
            $dashboard = Menu::create([
                'menu_name' => 'Dashboard',
                'menu_link' => 'dashboard',
                'parent_id' => null, // No parent, so it is a top-level menu
                'menu_icon' => 'icon-grid menu-icon'
            ]);
            $dashboardadmin = Menu::create([
                'menu_name' => 'Dashboard Admin',
                'menu_link' => 'dashboardadmin',
                'parent_id' => null, // No parent, so it is a top-level menu
                'menu_icon' => 'icon-grid menu-icon'
            ]);

            // Create Admin Menu with submenus
            $adminMenu = Menu::create([
                'menu_name' => 'Admin Menu',
                'menu_link' => '#', // No link for parent menu
                'parent_id' => null, // No parent, so it is a top-level menu
                'menu_icon' => 'icon-layout menu-icon'
            ]);

            $addRole = Menu::create([
                'menu_name' => 'Add Role',
                'menu_link' => 'addrole',
                'parent_id' => $adminMenu->menu_id, // Submenu of Admin Menu
                'menu_icon' => 'icon-grid-2 menu-icon'
            ]);

            $addMenu = Menu::create([
                'menu_name' => 'Add Menu',
                'menu_link' => 'addmenu',
                'parent_id' => $adminMenu->menu_id, // Submenu of Admin Menu
                'menu_icon' => 'icon-contract menu-icon'
            ]);

            $showBook = Menu::create([
                'menu_name' => 'Show Book',
                'menu_link' => 'showbook',
                'parent_id' => null, // No parent, so it is a top-level menu
                'menu_icon' => 'icon-bar-graph menu-icon'
            ]);

            $DosenMenu = Menu::create([
                'menu_name' => 'Dosen Menu',
                'menu_link' => '#', // No link for parent menu
                'parent_id' => null, // No parent, so it is a top-level menu
                'menu_icon' => 'icon-layout menu-icon'
            ]);

            $addbook = Menu::create([
                'menu_name' => 'Tambahkan Buku',
                'menu_link' => 'addbook',
                'parent_id' => $DosenMenu->menu_id, // or set the correct parent_id if needed
                'menu_icon' => 'icon-columns menu-icon'
            ]);
                
            $addkategori = Menu::create([
                'menu_name' => 'Tambahkan Kategori',
                'menu_link' => 'addkategori',
                'parent_id' => $DosenMenu->menu_id, // or set the correct parent_id if needed
                'menu_icon' => 'icon-columns menu-icon'
            ]);
            
            // Attach menus to MenuLevel
            $level1 = MenuLevel::find(1);
            $level1->menus()->saveMany([$dashboardadmin, $adminMenu, $showBook, $dashboard, $DosenMenu]);

            $level2 = MenuLevel::find(2);
            $level2->menus()->saveMany([$addRole, $addMenu,$addbook,$addkategori]);

            // Get Users
            $jenisuser1 = JenisUser::find(1); 
            $jenisuser2 = JenisUser::find(2); 
            $jenisuser3 = JenisUser::find(3); 

            // Attach menus to Users via setting_menu_user
            if ($jenisuser1) {
                $jenisuser1->menus()->attach([
                    $dashboardadmin->menu_id, 
                    $adminMenu->menu_id,
                    $addRole->menu_id,
                    $addMenu->menu_id
                ]);
            }
            if ($jenisuser3) {
                $jenisuser3->menus()->attach([
                    $dashboard->menu_id, 
                    $DosenMenu->menu_id,
                    $addbook->menu_id,
                    $addkategori->menu_id,
                ]);
            }
            if ($jenisuser2) {
                $jenisuser2->menus()->attach([
                    $dashboard->menu_id, 
                    $showBook->menu_id
                ]);
            }
        }
    }
