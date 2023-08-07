<?php

namespace App\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->status === 'consultant') {
                // $user = auth()->user()->guest->nama_tamu;
                return redirect()->intended('consultant-home');
            } else if (auth()->user()->status === 'VIP' || 'NONVIP') {
                $user = auth()->user()->guest->nama_tamu;
                return redirect()->intended('guest-home')->with('success', ('Selamat datang ' . $user . '!'));
            }
        }
        return back()->with('loginError', 'Login Failed!');
    }

    public function indexAdmin()
    {
        return view('admin.login-admin');
    }

    public function authenticateAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->status === 'admin') {
                return redirect()->intended('admin')->with('success', ('Selamat datang admin!'));
            }
        }
        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('id');
        $request->session()->invalidate();

        return redirect('/');
    }
}
