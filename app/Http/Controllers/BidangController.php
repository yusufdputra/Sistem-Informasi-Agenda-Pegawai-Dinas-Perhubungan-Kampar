<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;
use App\Models\User;

class BidangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Kelola Bidang";
        $bidang = Bidang::all();
        return view('admin.bidang.index', compact('bidang', 'title'));
    }

    public function store(Request $request)
    {
        $query = Bidang::insert([
            'name'=> $request->nama
        ]);
        if ($query) {
            return redirect()->back()->with('success', 'Bidang berhasil ditambah');
        }else{
            return redirect()->back()->with('alert', 'Bidang gagal ditambah');
        }
    }

    public function update(Request $request)
    {
        $query = Bidang::where('id', $request->id)
        ->update([
            'name'=> $request->nama
        ]);
        if ($query) {
            return redirect()->back()->with('success', 'Bidang berhasil diubah');
        }else{
            return redirect()->back()->with('alert', 'Bidang gagal diubah');
        }
    }

    public function hapus(Request $request)
    {
        $query = Bidang::where('id', $request->id)->delete();

        if ($query) {
            return redirect()->back()->with('success', 'Berhasil menghapus Bidang');
        } else {
            return redirect()->back()->with('alert', 'Gagal menghapus Bidang');
        }
    }
}
