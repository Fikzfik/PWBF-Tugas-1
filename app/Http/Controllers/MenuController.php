<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function addmenu($userId)
    {
        // Ambil data user berdasarkan ID
        $user = User::findOrFail($userId);
        
        // Ambil semua menu yang tersedia
        $menus = Menu::all();

        // Kirim data user dan menu ke view
        return view('add-menu-to-user', compact('user', 'menus'));
    }

    public function update(Request $request, $userId)
    {
        // Ambil user berdasarkan ID
        $user = User::findOrFail($userId);

        // Sinkronisasi menu yang dipilih dengan user
        $user->menus()->sync($request->input('menu_ids'));

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke user.');
    }
}
