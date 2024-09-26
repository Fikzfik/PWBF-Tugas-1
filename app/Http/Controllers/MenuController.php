<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\User;

class MenuController extends Controller
{
    // Menampilkan semua menu
    public function index()
    {
        $id_jenis_user = auth()->user()->id_jenis_user;

        $menususer = Menu::whereHas('jenisUsers', function ($query) use ($id_jenis_user) {
            $query->where('setting_menu_user.id_jenis_user', $id_jenis_user);
        })
            ->whereNull('parent_id')
            ->get();

        $submenus = Menu::whereHas('jenisUsers', function ($query) use ($id_jenis_user) {
            $query->where('setting_menu_user.id_jenis_user', $id_jenis_user);
        })
            ->whereNotNull('parent_id')
            ->get();

        $users = User::where('id_jenis_user', '!=', 1)->get();

        $menus = Menu::all();
        return view('admin.addmenu', [
            'users' => $users,
            'menususer' => $menususer,
            'menus' => $menus,
            'submenus' => $submenus,
        ]);
    }

    // Form untuk membuat menu baru
    public function create()
    {
        return view('menu.create');
    }

    // Menyimpan menu baru
    public function store(Request $request)
    {
        $request->validate([
            'menu_name' => 'required',
            'menu_link' => 'nullable',
            'menu_icon' => 'nullable',
            'parent_id' => 'nullable',
        ]);

        Menu::create($request->all());
        return redirect()->route('menu.index')->with('success', 'Menu created successfully.');
    }

    // Menampilkan detail menu
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.show', compact('menu'));
    }

    // Form untuk edit menu
    public function edit($id)
    {
        $id_jenis_user = auth()->user()->id_jenis_user;

        $menususer = Menu::whereHas('jenisUsers', function ($query) use ($id_jenis_user) {
            $query->where('setting_menu_user.id_jenis_user', $id_jenis_user);
        })
            ->whereNull('parent_id')
            ->get();

        $submenus = Menu::whereHas('jenisUsers', function ($query) use ($id_jenis_user) {
            $query->where('setting_menu_user.id_jenis_user', $id_jenis_user);
        })>w
            -hereNotNull('parent_id')
            ->get();

        $users = User::where('id_jenis_user', '!=', 1)->get();

        $menu = Menu::findOrFail($id);
        return view('admin.menuedit', [
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
            'menu' => $menu,
        ]);
    }

    // Mengupdate menu
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'menu_name' => 'required',
            'menu_link' => 'nullable',
            'menu_icon' => 'nullable',
            'parent_id' => 'nullable',
        ]);

        $menu->update($request->all());
        return redirect()->route('menu.index')->with('success', 'Menu updated successfully.');
    }

    // Menghapus menu
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu deleted successfully.');
    }
}
