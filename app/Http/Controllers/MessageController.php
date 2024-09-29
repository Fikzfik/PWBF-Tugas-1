<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\jenisUser;
use App\Models\User;
use App\Models\Menu;
use App\Models\Message;
use App\Models\MessageTo;
use App\Models\MessageDokumen;
use App\Models\MessageKategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function message()
    {
        $id_jenis_user = auth()->user()->id_jenis_user;

        // Ambil menus dan submenus untuk pengguna
        $menususer = auth()->user()->jenisUser->menus()->whereNull('parent_id')->get();
        $submenus = auth()->user()->jenisUser->menus()->whereNotNull('parent_id')->get();

        // Ambil semua pengguna yang bukan jenis user dengan id 1
        $users = User::where('id_jenis_user', '!=', 1)->get();

        // Ambil semua pesan untuk pengguna saat ini
        $messages = Message::where('user_id', Auth::id())->get();

        // Ambil pesan yang belum dibaca
        $unreadMessages = Message::where('massage_status', 'belum dibaca')
            ->where('user_id', Auth::id()) // Ganti dengan ID pengguna yang sesuai
            ->get();

        return view('massage.massage', [
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
            'messages' => $messages,
            'unreadMessages' => $unreadMessages, // Tambahkan unreadMessages ke view
        ]);
    }

    public function getUnreadMessages(Request $request)
    {
        // Ambil pesan yang belum dibaca untuk pengguna yang terautentikasi
        $unreadMessages = Message::where('massage_status', 'belum dibaca')->where('user_id', Auth::id())->get();

        return response()->json($unreadMessages);
    }

    public function sendmessage(Request $request)
    {
        $id_jenis_user = auth()->user()->id_jenis_user;

        $menususer = auth()->user()->jenisUser->menus()->whereNull('parent_id')->get();
        // @dd($id_jenis_user);
        $submenus = auth()->user()->jenisUser->menus()->whereNotNull('parent_id')->get();

        $users = User::where('id_jenis_user', '!=', 1)->get();
        $messages = Message::where('user_id', Auth::id())->get();
        $categories = MessageKategori::all();

        $to = $request->query('to', '');
        $subject = $request->query('subject', '');
        return view('massage.sendmessage', [
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
            'messages' => $messages,
            'categories' => $categories,
            'to' => $to,
            'subject' => $subject,
        ]);
    }
    // MessageController.php
    public function searchMessages(Request $request)
    {
        // Ambil keyword dari input search
        $search = $request->query('query');

        // Ambil data pesan yang cocok dengan subject
        $messages = Message::where('user_id', Auth::id())
            ->where('subject', 'LIKE', "%{$search}%")
            ->get();

        return response()->json([
            'messages' => $messages,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'message_text' => 'required|string',
            'category' => 'required',
            // 'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048', // Validasi file jika ada
        ]);

        // Buat pesan baru
        $massage = new Message();
        $massage->massage_reference = auth()->user()->email;
        $massage->subject = $request->subject;
        $massage->text = $request->message_text;
        $massage->massage_text = $request->message_text;
        $massage->massage_status = 'Belum Dibaca';
        $massage->no_mk = $request->category;

        // Temukan pengguna berdasarkan email
        $emailInput = $request->input('to');
        $user = User::where('email', $emailInput)->first();
        if ($user) {
            $massage->user_id = $user->user_id;
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Simpan pesan
        $massage->save();

        // Simpan penerima
        $massageTo = new MessageTo();
        $massageTo->to = $request->to;
        $massageTo->cc = auth()->user()->name;
        $massageTo->massage_id = $massage->massage_id;
        $massageTo->save();

        // Simpan file dokumen jika ada
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('documents', 'public');

            $dokumen = new MessageDokumen();
            $dokumen->file = $filePath;
            $dokumen->description = 'Attached file';
            $dokumen->massage_id = $massage->massage_id;
            $dokumen->save();
        }

        // Mengembalikan response JSON untuk AJAX
        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim!',
            'redirect' => route('message.compose'), // Gunakan route yang benar untuk redirect
        ]);
    }

    public function stores(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'sender' => 'required|email',
            'message' => 'required|string',
        ]);

        // Simpan pesan ke database
        Message::create([
            'subject' => $request->subject,
            'massage_reference' => $request->sender,
            'massage_status' => 'Unread',
            'message_body' => $request->message, // Sesuaikan sesuai dengan kolom di tabel Anda
        ]);

        return redirect()->route('mailbox.index')->with('success', 'Email sent successfully!');
    }
    public function show($id)
    {
        $id_jenis_user = auth()->user()->id_jenis_user;

        $menususer = auth()->user()->jenisUser->menus()->whereNull('parent_id')->get();
        $submenus = auth()->user()->jenisUser->menus()->whereNotNull('parent_id')->get();

        $users = User::where('id_jenis_user', '!=', 1)->get();
        $messages = Message::find($id);

        if (!$messages) {
            return redirect()->route('mailbox.index')->with('error', 'Message not found.');
        }

        // Ubah status pesan menjadi "Dibaca"
        $messages->massage_status = 'Dibaca';
        // @dd($dokumen, $messages->massage_id);
        $messages->save();
        
        $dokumen = MessageDokumen::where('massage_id', $messages->massage_id)->get(); // Menggunakan get() untuk mengambil koleksi
        // Ambil dokumen yang terkait dengan message_id

        // Debug untuk memastikan dokumen ditemukan

        // Kirim data ke view
        return view('massage.messageview', [
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
            'message' => $messages,
            'dokumen' => $dokumen, // Mengirim dokumen ke view
        ]);
    }
    public function destroy($id)
    {
        // Cari pesan berdasarkan ID
        $message = Message::find($id);

        // Jika pesan tidak ditemukan
        if (!$message) {
            return redirect()->route('mailbox.index')->with('error', 'Message not found.');
        }

        // Hapus pesan
        $message->delete();

        // Redirect dengan notifikasi sukses
        return redirect()->route('mailbox.index')->with('success', 'Message deleted successfully.');
    }
    public function compose(Request $request)
    {
        $id_jenis_user = auth()->user()->id_jenis_user;

        $menususer = auth()->user()->jenisUser->menus()->whereNull('parent_id')->get();
        // @dd($id_jenis_user);
        $submenus = auth()->user()->jenisUser->menus()->whereNotNull('parent_id')->get();

        return view('massage.compose', [
            'menususer' => $menususer,
            'submenus' => $submenus,
        ]);
    }
}
