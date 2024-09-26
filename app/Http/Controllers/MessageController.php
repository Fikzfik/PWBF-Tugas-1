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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function message()
    {
        $id_jenis_user = auth()->user()->id_jenis_user;

        $menususer = auth()->user()->jenisUser->menus()->whereNull('parent_id')->get();
        // @dd($id_jenis_user);
        $submenus = auth()->user()->jenisUser->menus()->whereNotNull('parent_id')->get();

        $users = User::where('id_jenis_user', '!=', 1)->get();
        $messages = Message::where('user_id', Auth::id())->get();

        return view('massage.massage', [
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
            'messages' => $messages
        ]);
    }
}
