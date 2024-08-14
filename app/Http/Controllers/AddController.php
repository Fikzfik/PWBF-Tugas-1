<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Buku; 
use Illuminate\Support\Facades\DB;

class AddController extends Controller
{
    public function store(Request $request)
    {
      

        $book = Buku::create([
            'pengarang' => $request->input('pengarang'),
            'judul' => $request->input('judul'),
            'kode' => $request->input('kode'),
        ]);
        // @dd($book);
  
        return redirect()->back()->with('success', 'Data buku berhasil ditambahkan!');
    }
    public function addbook(): View
{

    $books = Buku::where('status', true)->get();
    return view('add.book', ['books' => $books]);
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
}
