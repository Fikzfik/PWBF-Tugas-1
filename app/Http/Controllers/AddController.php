<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Buku; 
use App\Models\Kategori; 
use Illuminate\Support\Facades\DB;

class AddController extends Controller
{
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
        $book = Kategori::create([
            'nama_kategori' => $request->input('kategori'),
        ]);
        // @dd($book);
  
        return redirect()->back()->with('success', 'Data buku berhasil ditambahkan!');
    }
    public function addbook(): View
    {
    $kategori = Kategori::all();
    $books = Buku::where('status', true)->get();
    return view('add.book', ['books' => $books,'kategori' => $kategori]);
    }
    public function addkategori(): View
    {

    $kategori = Kategori::where('status', true)->get();
    return view('add.kategori', ['kategori' => $kategori]);
    }
    public function destroy($id)
    {
     
        $book = Buku::find($id);
        if ($book) {
            $book->status = false; 
            $book->save();
            return redirect()->back()->with('success', 'Buku berhasil dihapus!');
        }
        return redirect()->back()->with('error', 'Buku tidak ditemukan!');
    }
    public function dashboard(){
        return view('dashboard');
    }
}
