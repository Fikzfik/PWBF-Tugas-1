<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\jenisUser;
use App\Models\Posting;
use App\Models\PostingLike;
use App\Models\PostingKomen;
use App\Models\User;
use App\Models\Menu;
use App\Models\Message;
use App\Models\MessageTo;
use App\Models\MessageDokumen;
use App\Models\MessageKategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SocialFeedController extends Controller
{
    public function deleteComment($id)
    {
        // Cari komentar berdasarkan ID
        $comment = PostingKomen::findOrFail($id);

        // Pastikan komentar tersebut milik user yang sedang login
        if ($comment->user_id == auth()->user()->user_id) {
            $comment->delete();
            return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }
    }

    public function index()
    {
        $id_jenis_user = auth()->user()->id_jenis_user;

        $menususer = auth()->user()->jenisUser->menus()->whereNull('parent_id')->get();
        // @dd($id_jenis_user);
        $submenus = auth()->user()->jenisUser->menus()->whereNotNull('parent_id')->get();

        $users = User::where('id_jenis_user', '!=', 1)->get();
        $jenis_user = JenisUser::all();
        // @dd($postings);
        $postings = Posting::all();
        return view('posting.index', [
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
            'jenis_user' => $jenis_user,
            'postings' => $postings,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message_text' => 'required',
            'message_gambar' => 'nullable|image',
        ]);

        $posting = new Posting();
        $posting->sender = auth()->user()->user_id;
        $posting->message_text = $request->message_text;

        if ($request->hasFile('message_gambar')) {
            $path = $request->file('message_gambar')->store('documents', 'public');
            $posting->message_gambar = $path;
        }

        $posting->CREATE_BY = auth()->user()->name;
        $posting->save();

        return redirect()->back()->with('success', 'Posting created successfully!');
    }

    public function like($id)
    {
        // Cek apakah user sudah menyukai postingan ini
        $existingLike = PostingLike::where('posting_id', $id)
            ->where('user_id', auth()->user()->user_id)
            ->first();

        if ($existingLike) {
            // Jika like sudah ada, maka lakukan unlike (hapus like)
            $existingLike->delete();
        } else {
            // Jika like belum ada, tambahkan like baru
            $like = new PostingLike();
            $like->posting_id = $id;
            $like->user_id = auth()->user()->user_id;
            $like->create_by = auth()->user()->name;
            $like->save();
        }

        return redirect()->back();
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'komentar_text' => 'required',
        ]);

        $comment = new PostingKomen();
        $comment->posting_id = $id;
        $comment->user_id = auth()->user()->user_id;
        $comment->komentar_text = $request->komentar_text;
        $comment->create_by = auth()->user()->name;
        $comment->save();

        return redirect()->back();
    }
}
