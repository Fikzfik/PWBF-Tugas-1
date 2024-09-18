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
    public function setting(Request $request){
        $roles = jenisUser::all();
        $users = Auth::user();
        return view('add.settings',['users' => $users,'roles' => $roles]);
    }

    public function store(Request $request)
    {
        
        $book = Buku::create([
            'pengarang' => $request->input('pengarang'),
            'judul' => $request->input('judul'),
            'kode' => $request->input('kode'),
            'id_kategori' => $request->input('id_kategori')
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
    $kategori = Kategori::all();
    $books = Buku::where('status', true)->get();
    return view('add.book', ['books' => $books,'kategori' => $kategori]);
    }

    public function deleteall(Request $request)
    {
        // Mengecek apakah ada selected_books yang dikirimkan (penghapusan massal)
        if ($request->has('selected_books')) {
            // Ambil array ID buku yang dipilih
            $selectedBooks = $request->input('selected_books');

            // Memastikan array tidak kosong
            if (!empty($selectedBooks)) {
                // Mengubah status buku yang dipilih menjadi false (penghapusan massal)
                Buku::whereIn('id_buku', $selectedBooks)->update(['status' => false]);

                return redirect()->back()->with('success', 'Buku yang dipilih berhasil dihapus!');
            }

            return redirect()->back()->with('error', 'Tidak ada buku yang dipilih untuk dihapus!');
        }

        return redirect()->back()->with('error', 'Permintaan tidak valid!');
    }
    public function addkategori(): View
    {

    $kategori = Kategori::where('status', true)->get();
    return view('add.kategori', ['kategori' => $kategori]);
    }

    public function destroy(Request $request, $id = null)
    {
        // Jika ada request dengan selected_books (penghapusan massal)
        if ($request->has('selected_books')) {
            $selectedBooks = $request->input('selected_books');

            // Ubah status menjadi false untuk buku yang dipilih
            Buku::whereIn('id_buku', $selectedBooks)->update(['status' => false]);

            return redirect()->back()->with('success', 'Buku yang dipilih berhasil dihapus!');
        }

        // Jika $id diberikan (penghapusan individual)
        if ($id) {
            $book = Buku::find($id);

            if ($book) {
                $book->status = false;  // Ubah status menjadi false
                $book->save();

                return redirect()->back()->with('success', 'Buku berhasil dihapus!');
            }

            return redirect()->back()->with('error', 'Buku tidak ditemukan!');
        }

        return redirect()->back()->with('error', 'Tidak ada buku yang dipilih untuk dihapus!');
    }
    public function destroykategori($id)
    {
     
        $kategori
         =  Kategori::find($id);
        if ($kategori) {
            $kategori->status = false; 
            $kategori->save();
            return redirect()->back()->with('success', 'Buku berhasil dihapus!');
        }
        return redirect()->back()->with('error', 'Buku tidak ditemukan!');
    }

    public function dashboard(){
        return view('dashboard');
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
            // Mengambil semua pengguna dengan jenis user ID yang tidak sama dengan 1
            $users = User::where('id_jenis_user', '!=', 1)->get();
            
            // Mengambil semua menu
            $menus = Menu::all();

            return view('dashboardadmin', [
                'users' => $users,
                'menus' => $menus
            ]);
        }

    public function updateRole(Request $request, $id)
    {
    // Validasi input
          $request->validate([
            'menu_id' => 'required|exists:menu,menu_id',
        ]);

        // Cari user berdasarkan ID
        $user = User::find($id);

        // Tambahkan menu ke user
        $user->menus()->attach($request->menu_id);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke user.');
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
        $user = User::find($id);
        return view('admin.edituser',['user'=>$user]);
    }

    public function updateuser(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->no_hp = $request->input('no_hp');
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
