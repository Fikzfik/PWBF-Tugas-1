<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\jenisUser;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AddController extends Controller
{
    public function setting(Request $request)
    {
        $roles = jenisUser::all();
        $users = Auth::user();
        return view('add.settings', ['users' => $users, 'roles' => $roles]);
    }

    public function store(Request $request)
    {
        $book = Buku::create([
            'pengarang' => $request->input('pengarang'),
            'judul' => $request->input('judul'),
            'kode' => $request->input('kode'),
            'id_kategori' => $request->input('id_kategori'),
        ]);
        // @dd($book);

        return redirect()->back()->with('success', 'Data buku berhasil ditambahkan!');
    }

    public function storekategori(Request $request)
    {
        // Cek apakah kategori sudah ada di database
        $kategori = Kategori::where('nama_kategori', $request->input('kategori'))->first();

        if ($kategori) {
            // Jika kategori ditemukan dan statusnya false, ubah status menjadi true
            if ($kategori->status == false) {
                $kategori->status = true;
                $kategori->save();

                return redirect()->back()->with('success', 'Kategori sudah ada, statusnya diaktifkan kembali!');
            } else {
                // Jika kategori sudah ada dan statusnya true
                return redirect()->back()->with('error', 'Kategori sudah ada!');
            }
        } else {
            // Jika kategori belum ada, buat kategori baru
            Kategori::create([
                'nama_kategori' => $request->input('kategori'),
            ]);

            return redirect()->back()->with('success', 'Kategori baru berhasil ditambahkan!');
        }
    }

    public function addbook(): View
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

        $kategori = Kategori::where('status', true)->get();
        $books = Buku::where('status', true)->get();
        return view('add.book', ['books' => $books, 'kategori' => $kategori, 'users' => $users, 'menususer' => $menususer, 'submenus' => $submenus]);
    }

    public function deleteall(Request $request)
    {
        if ($request->has('selected_books')) {
            $selectedBooks = $request->input('selected_books');

            if (!empty($selectedBooks)) {
                // Mengubah status buku yang dipilih menjadi false (penghapusan massal)
                Buku::whereIn('id_buku', $selectedBooks)->update(['status' => false]);

                return redirect()->back()->with('success', 'Buku yang dipilih berhasil dihapus!');
            }

            return redirect()->back()->with('error', 'Tidak ada buku yang dipilih untuk dihapus!');
        }

        return redirect()->back()->with('error', 'Permintaan tidak valid!');
    }
    public function addkategori()
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

        $kategori = Kategori::where('status', true)->get();

        return view('add.kategori', [
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
            'kategori' => $kategori,
        ]);
    }

    public function destroys(Request $request)
    {
        if ($request->has('selected_books')) {
            $selectedBooks = $request->input('selected_books');

            // Ubah status menjadi false untuk buku yang dipilih
            Buku::whereIn('id_buku', $selectedBooks)->update(['status' => false]);

            return response()->json(['success' => true, 'message' => 'Buku yang dipilih berhasil dihapus!']);
        }

        return response()->json(['success' => false, 'message' => 'Tidak ada buku yang dipilih untuk dihapus!']);
    }
    public function destroy($id)
    {
        $book = Buku::find($id);

        if ($book) {
            $book->status = false; // Ubah status menjadi false
            $book->save();

            return response()->json(['success' => true, 'message' => 'Buku berhasil dihapus.']);
        }
        return response()->json(['success' => false, 'message' => 'Buku tidak ditemukan.']);
    }

    public function destroykategori($id)
    {
        // @dd($id);
        $kategori = Kategori::find($id);

        if ($kategori) {
            $kategori->status = false; // Ubah status menjadi false
            $kategori->save();
            return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
        }
        return redirect()->back()->with('error', 'Kategori tidak ditemukan!');
    }

    public function dashboard()
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

        return view('dashboard', [
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
        ]);
    }
    public function addMenuuser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Menambahkan beberapa menu
        if ($request->has('menu_id')) {
            $user->menus()->attach($request->menu_id);
        }

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke user.');
    }

    public function dashboardadmin()
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

        return view('dashboardadmin', [
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
        ]);
    }

    public function updatemenurole($id)
    {
        $role = JenisUser::findOrFail($id);
        $menuroles = $role->menus;
        $idmenuroles = $role->menus()->pluck('menu.menu_id')->toArray();
        $notmenuroles = Menu::whereNotIn('menu_id', $idmenuroles)->get();
        // @dd($menuroles, $notmenuroles);

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

        return view('admin.addmenuroles', [
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
            'role' => $role,
            'menuroles' => $menuroles,
            'notmenuroles' => $notmenuroles,
        ]);
    }
    public function savemenu(Request $request, $id)
    {
        $role = JenisUser::findOrFail($id);

        $selectedMenus = $request->input('menu_id', []);

        $currentMenus = $role->menus()->pluck('menu.menu_id')->toArray();

        $menusToAdd = array_diff($selectedMenus, $currentMenus);

        $menusToRemove = array_diff($currentMenus, $selectedMenus);

        if (!empty($menusToAdd)) {
            $role->menus()->attach($menusToAdd);
        }

        if (!empty($menusToRemove)) {
            $role->menus()->detach($menusToRemove);
        }

        return redirect()
            ->route('roles.addmenu', $role->id_jenis_user)
            ->with('success', 'Menus have been updated successfully.');
    }

    public function usersubmit(Request $request)
    {
        // Debug sebelum create
        // @dd($request->all());

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make('qwe123'),
            'no_hp' => $request->input('no_hp'),
            'id_jenis_user' => $request->input('id_jenis_user'),
        ]);

        // @dd($user);

        return redirect()->route('dashboardadmin')->with('success', 'User berhasil didaftarkan');
    }

    public function edituser($id)
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

        $user = User::find($id);
        return view('admin.edituser', [
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
            'user' => $user,
        ]);
    }

    public function updateuser(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->no_hp = $request->input('no_hp');
        $user->id_jenis_user = $request->input('id_jenis_user');
        $user->save();

        return redirect()->route('dashboardadmin')->with('success', 'User berhasil diupdate');
    }

    public function destroyuser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('dashboardadmin')->with('success', 'User berhasil dihapus');
    }
}
