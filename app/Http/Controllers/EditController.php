<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery\Generator\StringManipulation\Pass\Pass;

class EditController extends Controller
{
    public function editPass()
    {
        return view('guest.edit-pass', [
            'title' => 'Edit Password'
        ]);
    }

    public function changePass(Request $request)
    {
        // $user = Auth::user();
        $userPassword = auth()->user()->password;
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password|min:8',
            'confirm_password' => 'required'
        ]);
        if (!Hash::check($request->current_password, $userPassword)) {
            return back()->withErrors(['current_password' => 'password not match']);
        }
        $new_password = Hash::make($request->new_password);

        // auth()->user()->password->save();
        User::where('id', auth()->user()->id)->update(['password' => $new_password]);

        return redirect()->back()->with('success', 'password successfully update');
    }
}
