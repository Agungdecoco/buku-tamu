<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->status === 'consultant') {
                return response()->json(['redirect' => 'consultant-home']);
            } else if (auth()->user()->status === 'VIP' || 'NONVIP') {
                $user = auth()->user()->guest->nama_tamu;
                return response()->json(['redirect' => 'guest-home', 'message' => 'Selamat datang ' . $user . '!']);
            }
        }

        return response()->json(['error' => 'Login Failed!'], 401);
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
                return response()->json(['redirect' => 'admin', 'message' => 'Selamat datang admin!']);
            }
        }

        return response()->json(['error' => 'Login Failed!'], 401);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('id');
        $request->session()->invalidate();

        return response()->json(['redirect' => '/']);
    }
}
