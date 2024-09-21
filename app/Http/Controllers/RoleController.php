<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisUser;
use App\Models\User;
use App\Models\Menu;

class RoleController extends Controller
{
    public function index()
    {
        $id_jenis_user = auth()->user()->id_jenis_user;

        $menususer = Menu::whereHas('jenisUsers', function ($query) use ($id_jenis_user) {
        $query->where('setting_menu_user.id_jenis_user', $id_jenis_user);
        })->whereNull('parent_id')->get();

        $submenus = Menu::whereHas('jenisUsers', function ($query) use ($id_jenis_user) {
        $query->where('setting_menu_user.id_jenis_user', $id_jenis_user);
        })->whereNotNull('parent_id')->get();

        $users = User::where('id_jenis_user', '!=', 1)->get();

        $roles = JenisUser::all();
        return view('admin.addrole', [
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
            'roles' => $roles
        ]);
      
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'nama_jenis_user' => 'required|string|max:255',
        ]);

        // Create a new JenisUser
        JenisUser::create([
            'nama_jenis_user' => $request->input('nama_jenis_user'),
        ]);

        // Redirect with success message
        return redirect()->route('admin.addrole')->with('success', 'Jenis User added successfully');
    }

    public function edit($id)
    {
        $id_jenis_user = auth()->user()->id_jenis_user;

    $menususer = Menu::whereHas('jenisUsers', function ($query) use ($id_jenis_user) {
        $query->where('setting_menu_user.id_jenis_user', $id_jenis_user);
    })->whereNull('parent_id')->get();

    $submenus = Menu::whereHas('jenisUsers', function ($query) use ($id_jenis_user) {
        $query->where('setting_menu_user.id_jenis_user', $id_jenis_user);
    })->whereNotNull('parent_id')->get();

    $users = User::where('id_jenis_user', '!=', 1)->get();
    $role = JenisUser::findOrFail($id);

    return view('admin.updaterole', [
        'users' => $users,
        'menususer' => $menususer,
        'submenus' => $submenus,
        'role' => $role
    ]);
       
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ]);

        $role = JenisUser::findOrFail($id);
        $role->update([
            'nama_jenis_user' => $request->input('role_name'),
        ]);

        return redirect()->route('admin.addrole')->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        $role = JenisUser::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.addrole')->with('success', 'Role deleted successfully');
    }
    public function show($id)
    {
        $id_jenis_user = auth()->user()->id_jenis_user;
        $menususer = Menu::whereHas('jenisUsers', function ($query) use ($id_jenis_user) {
            $query->where('setting_menu_user.id_jenis_user', $id_jenis_user);
        })->whereNull('parent_id')->get();

        $submenus = Menu::whereHas('jenisUsers', function ($query) use ($id_jenis_user) {
            $query->where('setting_menu_user.id_jenis_user', $id_jenis_user);
        })->whereNotNull('parent_id')->get();

        $users = User::where('id_jenis_user', '!=', 1)->get();

        $role = JenisUser::findOrFail($id);

        // Misalkan ada relasi dengan model lain, seperti Menu
        $menus = $role->menus; // Jika Anda memiliki relasi dengan menu
        return view('admin.showrole', [
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
            'role'=>$role,
            'menus'=> $menus
        ]);
    }
}
