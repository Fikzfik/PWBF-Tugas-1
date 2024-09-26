<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function loginview(): view
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $userrole = $user->id_jenis_user;

            $redirectPath = $userrole == 1 ? 'dashboardadmin' : 'dashboard';

            return response()->json([
                'success' => true,
                'message' => 'Great! You have successfully logged in',
                'redirect' => url($redirectPath),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Login failed. Please check your credentials.',
            ]);
        }
    }

    public function registerview(): view
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'id_jenis_user' => 2, // Relasi ke jenis_user admin
        ]);
        // @dd($request);
        Auth::login($user);
        return redirect('dashboard')->with('user', $user)->withSuccess('Great! You have Successfully logged in');
    }
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect('login')->with('success', 'Great! You have successfully logged out');
    }
}
