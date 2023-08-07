<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Http\Requests\StoreGuestRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateGuestRequest;
use App\Models\User;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $auth_user = auth()->user()->guest->nip;
        // $guest = Guest::where('nip', $auth_user);
        // return view('guest.profile', compact('guest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGuestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGuestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function show(Guest $guest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function edit(Guest $guest)
    {
        // return view('guest.profile', [
        //     'user' => auth()->user()
        // ]);
        $user_guest = auth()->user()->guest->nip;
        $users = User::all();
        $guests = DB::table('guests')->where('nip', $user_guest)->get();
        // passing data pegawai yang didapat ke view edit.blade.php
        // return view('guest.biodata', ['guests' => $guests]);
        return view('guest.biodata', compact('guests', 'users'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGuestRequest  $request
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guest $guest)
    {
        $guest_nip = auth()->user()->guest->nip;
        $user_id = auth()->user()->id;

        // update data pegawai
        DB::table('guests')->where('nip', $guest_nip)->update([
            'nama_tamu' => $request->nama,
            'tlp_tamu' => $request->tlp,
            'jabatan_tamu' => $request->jabatan,
            'instansi' => $request->instansi
        ]);

        DB::table('users')->where('id', $user_id)->update([
            'email' => $request->email,
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect('biodata');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest)
    {
        //
    }

    public function upload()
    {
        $guest = Guest::get();
        return view('guest.foto-profil', ['guest' => $guest]);
    }

    public function fileUpload(Request $request)
    {
        $this->validate($request, [
            'foto' => 'required|file|image|mimes:jpeg,png,jpg',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $foto = $request->file('foto');

        $nama_file = time() . "_" . $foto->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'user_file';
        $foto->move($tujuan_upload, $nama_file);

        // Guest::create([
        //     'file' => $nama_file,
        // ]);
        Guest::where('nip', auth()->user()->guest->nip)->update(['foto' => $nama_file]);

        return redirect()->back();
    }
}
