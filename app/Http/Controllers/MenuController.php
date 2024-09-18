<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    // Menampilkan semua menu
    public function index()
    {
        $menus = Menu::all();
        return view('admin.addmenu', compact('menus'));
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
        $menu = Menu::findOrFail($id);
        return view('menu.edit', compact('menu'));
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
