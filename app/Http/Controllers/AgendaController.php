<?php

namespace App\Http\Controllers;

use App\Mail\SendMailToPegawai;
use App\Models\Agenda;
use App\Models\Bidang;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Kelola Agenda";

        $agenda = Agenda::with('users')->get();

        return view('admin.agenda.index', compact('title', 'agenda'));
    }

    public function tambah()
    {
        $title = "Tambah Agenda Harian";
        $bidang = Bidang::all();
        $pegawai = User::all();

        return view('admin.agenda.tambah', compact('title', 'bidang', 'pegawai'));
    }
    public function edit($id)
    {
        $title = "Edit Agenda";
        $agenda = Agenda::find($id);
        $bidang = Bidang::all();
        $pegawai = User::all();

        return view('admin.agenda.edit', compact('title', 'bidang', 'pegawai', 'agenda'));
    }

    public function store(Request $request)
    {
        // cek
        if ($request->jenis_tujuan != 'tujuan_semua') {
            $request->validate([
                'tujuan' => 'required',
            ]);
        }

        // date format
        $date = $request->tanggal;
        $date = Carbon::parse($date)->format('Y-m-d');

        $tujuan_orang = null;
        $tujuan_bidang = null;
        if ($request->jenis_tujuan == 'tujuan_orang') {
            $tujuan_orang = $request->tujuan;
        } else {
            $tujuan_bidang = $request->tujuan;
        }
        // olah file
        // get nama file
        if ($request->file_upload == null) {
            $file_path = null;
        } else {
            $file = $request->file('file_upload');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file_path = $file->storeAs('uploads', $file_name, 'public');
            $file_path =  $file_path;
        }

        $query = Agenda::insert([
            'nomor_surat' => $request->nomor_surat,
            'tanggal' => $date,
            'jam' => $request->jam,
            'jam2' => $request->jam2,
            'tempat' => $request->tempat,
            'keterangan' => $request->keterangan,
            'jenis_agenda' => $request->jenis_agenda,
            'tujuan_jenis' => $request->jenis_tujuan,
            'tujuan_orang' => $tujuan_orang,
            'tujuan_bidang' => $tujuan_bidang,
            'file_upload' => $file_path,
            'created_at' => Carbon::now()

        ]);
        if ($query) {
            $detail = [
                'title' => 'Agenda Baru',
                'tanggal' => $date,
                'jam' => $request->jam,
                'jam2' => $request->jam2,
                'tempat' => $request->tempat,
                'keterangan' => $request->keterangan
            ];
            // send ke email
            // jika tujuan per orangan
            if ($request->jenis_tujuan == 'tujuan_orang') {
                // get email tujuan pegawai
                $email = User::select('email')->find($tujuan_orang);
                // send mail
                try {
                    Mail::to($email['email'])->send(new SendMailToPegawai($detail));
                } catch (\Throwable $th) {
                    return redirect('agenda')->with('alert', 'Agenda Berhasil di Tambah, Namun gagal dikirim ke email tujuan');
                }
            } else if ($request->jenis_tujuan == 'tujuan_bidang') {
                // get email dari id bidang
                $email = User::select('email')->where('id_bidang', $tujuan_bidang)->get();
                foreach ($email as $key => $value) {
                    try {
                        Mail::to($value->email)->send(new SendMailToPegawai($detail));
                    } catch (\Throwable $th) {
                        return redirect('agenda')->with('alert', 'Agenda Berhasil di Tambah, Namun gagal dikirim ke email tujuan');
                    }
                }
            } else if ($request->jenis_tujuan == 'tujuan_semua') {
                // get email semua
                $email = User::select('email')->get();
                foreach ($email as $key => $value) {
                    try {
                        Mail::to($value->email)->send(new SendMailToPegawai($detail));
                    } catch (\Throwable $th) {
                        return redirect('agenda')->with('alert', 'Agenda Berhasil di Tambah, Namun gagal dikirim ke email semua pegawai');
                    }
                }
            }

            return redirect('agenda')->with('success', 'Agenda berhasil ditambah dan Berhasil terkirim ke Email Pegawai');
        } else {
            return redirect()->back()->with('alert', 'Agenda gagal ditambah');
        }
    }

    public function update(Request $request)
    {
        // cek
        if ($request->jenis_tujuan != 'tujuan_semua') {
            $request->validate([
                'tujuan' => 'required',
            ]);
        }

        // date format
        $date = $request->tanggal;
        $date = Carbon::parse($date)->format('Y-m-d');

        $tujuan_orang = null;
        $tujuan_bidang = null;
        if ($request->jenis_tujuan == 'tujuan_orang') {
            $tujuan_orang = $request->tujuan;
        } else {
            $tujuan_bidang = $request->tujuan;
        }
        // olah file
        // get nama file

        // jika file sebelumnya ada dan tidak ada upload file baru
        if ($request->file_already != null && $request->file_upload == null) {
            $file_path =  $request->file_already;
        }
        // jika file sebelumnya tidak ada dan tidak ada upload file baru  
        else if ($request->file_already == null && $request->file_upload == null) {
            $file_path = null;
        }
        // jika file sebelumnya ada dan ada upload baru
        else if ($request->file_upload != null) {
            if ($request->file_already != null) {
                // hapus file yg lama
                unlink(storage_path('app/public/' . $request->file_already));
            }
            // upload file baru
            $file = $request->file('file_upload');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file_path = $file->storeAs('uploads', $file_name, 'public');
            $file_path = $file_path;
        }

        $query = Agenda::where('id', $request->id)
            ->update([
                'nomor_surat' => $request->nomor_surat,
                'tanggal' => $date,
                'jam' => $request->jam,
                'jam2' => $request->jam2,
                'tempat' => $request->tempat,
                'keterangan' => $request->keterangan,
                'jenis_agenda' => $request->jenis_agenda,
                'tujuan_jenis' => $request->jenis_tujuan,
                'tujuan_orang' => $tujuan_orang,
                'tujuan_bidang' => $tujuan_bidang,
                'file_upload' => $file_path

            ]);
        if ($query) {
            $detail = [
                'title' => 'Agenda diubah',
                'tanggal' => $date,
                'jam' => $request->jam,
                'jam2' => $request->jam2,
                'tempat' => $request->tempat,
                'keterangan' => $request->keterangan
            ];
            // send ke email
            // jika tujuan per orangan
            if ($request->jenis_tujuan == 'tujuan_orang') {
                // get email tujuan pegawai
                $email = User::select('email')->find($tujuan_orang);
                // send mail
                try {
                    Mail::to($email['email'])->send(new SendMailToPegawai($detail));
                } catch (\Throwable $th) {
                    return redirect('agenda')->with('alert', 'Agenda Berhasil diubah, Namun gagal dikirim ke email tujuan');
                }
            } else if ($request->jenis_tujuan == 'tujuan_bidang') {
                // get email dari id bidang
                $email = User::select('email')->where('id_bidang', $tujuan_bidang)->get();
                foreach ($email as $key => $value) {
                    try {
                        Mail::to($value->email)->send(new SendMailToPegawai($detail));
                    } catch (\Throwable $th) {
                        return redirect('agenda')->with('alert', 'Agenda Berhasil diubah, Namun gagal dikirim ke email tujuan');
                    }
                }
            } else if ($request->jenis_tujuan == 'tujuan_semua') {
                // get email semua
                $email = User::select('email')->get();
                foreach ($email as $key => $value) {
                    try {
                        Mail::to($value->email)->send(new SendMailToPegawai($detail));
                    } catch (\Throwable $th) {
                        return redirect('agenda')->with('alert', 'Agenda Berhasil di Tambah, Namun gagal dikirim ke email semua pegawai');
                    }
                }
            }
            return redirect('agenda')->with('success', 'Agenda berhasil diubah dan Berhasil terkirim ke Email Pegawai');
        } else {
            return redirect()->back()->with('alert', 'Agenda gagal diubah');
        }
    }

    public function getToday()
    {
        $agenda = Agenda::whereDate('agenda_harians.tanggal', Carbon::today())
            ->get();
        return $agenda;
    }

    public function hapus(Request $request)
    {
        // hapus file yg ada
        $file_path = Agenda::find($request->id, ['file_upload']);
        if ($file_path['file_upload'] != null) {
            unlink(storage_path('app/public/' . $file_path['file_upload']));
        }

        Agenda::where('id', $request->id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus agenda');
    }
}
