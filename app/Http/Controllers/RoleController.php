<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisUser;

class RoleController extends Controller
{
    public function index()
    {
        $roles = JenisUser::all();
        return view('admin.addrole', ['roles' => $roles]);
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
        $role = JenisUser::findOrFail($id);
        return view('admin.updaterole', ['role' => $role]);
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
        $role = JenisUser::findOrFail($id);

        // Misalkan ada relasi dengan model lain, seperti Menu
        $menus = $role->menus; // Jika Anda memiliki relasi dengan menu

        return view('admin.showrole', ['role'=>$role,'menus'=> $menus]);
    }
}
