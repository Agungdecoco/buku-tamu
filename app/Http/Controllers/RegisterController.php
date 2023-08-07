<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guest;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
        $validate_guest = $request->validate([
            'nip' => 'required|max:21|unique:guests',
            'nama_tamu' => 'required|max:255',
            // 'users_id' => 'required',
            'tlp_tamu' => 'required|max:13',
            // 'email_tamu' => 'required|email:dns|unique:guests',
            'jabatan_tamu' => 'required',
            'instansi' => 'required|max:255',
            // 'status' => 'required'
            // 'password' => 'required|min:8',
        ]);

        $validate_user = $request->validate([
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8',
            'status' => 'required'
        ]);

        $validate_user['password'] = Hash::make($validate_user['password']);

        $create_user = User::create($validate_user);
        $validate_guest['users_id'] = $create_user->id;
        Guest::create($validate_guest);

        // event(new Registered($create_user));

        return redirect('login')->with('success', 'Registration has success! Please login');
    }

    // public function handle()
    // {
    //     event(new Registered());
    // }
}
