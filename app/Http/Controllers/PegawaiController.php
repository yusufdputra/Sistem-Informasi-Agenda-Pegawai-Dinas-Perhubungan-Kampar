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
        if ($request->email != $request->old_email) {
            $request->validate([
                'email' => 'required|unique:users|max:255',
            ]);
        }
        User::where('id', $request->id)
            ->update([
                'nip' => $request->nip,
                'name' => $request->nama,
                'nomor_hp' => $request->nomor_hp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'jabatan' => $request->jabatan,
                'id_bidang' => $request->bidang,
                'email' => $request->email,

            ]);

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function hapus(Request $request)
    {

        $query = User::where('id', $request->id)
            ->delete();

        if ($query) {
            return redirect()->back()->with('success', 'Berhasil menghapus pegawai');
        } else {
            return redirect()->back()->with('alert', 'Gagal menghapus pegawai');
        }
    }

    public function resetpw(Request $request)
    {
        $query = User::where('id', $request->id)
            ->update([
                'password' => bcrypt($request->password)
            ]);

        if ($query) {
            return redirect()->back()->with('success', 'Password User berhasil diubah');
        } else {
            return redirect()->back()->with('alert', 'Password User gagal diubah');
        }
    }
}
