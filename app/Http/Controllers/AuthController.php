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
    public function registerview(): view
    {
        return view('register');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
        }
        return redirect('dashboard')->with('user', $user)->withSuccess('Great! You have Successfully logged in');
    }
    public function register(Request $request)
    {  
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
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
