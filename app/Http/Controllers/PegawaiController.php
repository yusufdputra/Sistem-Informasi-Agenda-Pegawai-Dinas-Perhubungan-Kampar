<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Kelola Data Pegawai";
        $users = User::with('roles')->get();
        $pegawai = $users->reject(function ($admin, $key) {
            return $admin->hasRole('admin');
        });


        $bidang = Bidang::all();

        return view('admin.pegawai.index', compact('pegawai', 'title', 'bidang'));
    }

    public function tambah(Request $request)
    {

        // validasi apakah email sudah terdaftar atau belum
        $query = User::where('email',  $request->input('email'));
        if ($query->exists()) { //jika ada
            return redirect()->back()->with('alert', 'Email Sudah terdaftar');
        } else { // jika belum 

            
            $user = User::create([
                'nip' => $request->nip,
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'nomor_hp' => $request->nomor_hp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'jabatan' => $request->jabatan,
                'id_bidang' => $request->bidang

            ]);

            $user->assignRole('pegawai');
            return redirect()->back()->with('success', 'Email berhasil terdaftar');
        }
    }

    public function edit($id)
    {
        return User::find($id);
    }

    public function update(Request $request)
    {
        User::where('id', $request->id)
        ->update([
            'nip' => $request->nip,
            'name' => $request->nama,
            'nomor_hp' => $request->nomor_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'id_bidang' => $request->bidang
        ]);

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }
}
