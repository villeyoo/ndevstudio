<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Laporan;

class ReportController extends Controller
{
    // =========================
    // FORM LAPORAN
    // =========================
    public function form()
    {
        return view('laporan');
    }

    // =========================
    // SIMPAN LAPORAN
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'nullable|string|max:255',
            'kontak'     => 'nullable|string|max:255',
            'kategori'   => 'required|string|max:50',
            'isi'        => 'required|string',
            'attachment' => 'nullable|file|max:10240',
        ]);

        $path = null;


        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            if ($file && $file->isValid()) {

                $folder = storage_path('app/public/laporan');
                if (!is_dir($folder)) {
                    mkdir($folder, 0755, true);
                }

                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($folder, $filename);

                $path = 'laporan/' . $filename;
            }
        }

        // =========================
        // GENERATE TOKEN
        // =========================
        $token = strtoupper(Str::random(10));

        // =========================
        // SIMPAN KE DATABASE
        // =========================
        Laporan::create([
            'nama'       => $request->nama,
            'kontak'     => $request->kontak,
            'kategori'   => $request->kategori,
            'isi'        => $request->isi,
            'attachment' => $path,
            'token'      => $token,
            'status'     => 'DITERIMA',
        ]);

        // =========================
        // KIRIM KE SESSION
        // =========================
        return back()
            ->with('success', 'Laporan berhasil dikirim!')
            ->with('token', $token);
    }

     public function cekForm()
    {
        return view('ceklaporan');
    }

    /* =======================
       PROSES CEK LAPORAN
    ======================== */
    public function cekProses(Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);

        $laporan = Laporan::where('token', $request->token)->first();

        if (!$laporan) {
            return back()->withErrors(['token' => 'Token tidak ditemukan']);
        }

        return view('ceklaporan', compact('laporan'));
    }
}
