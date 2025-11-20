<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasusBukti;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class KasusController extends Controller
{
    // ===========================
    // TAMPILKAN LIST KASUS
    // ===========================
    public function index()
    {
        $data = KasusBukti::orderBy('created_at', 'DESC')->get();
        return view('case', compact('data'));
    }

    // ===========================
    // SIMPAN BUKTI KASUS (ANTI ERROR)
    // ===========================
    public function tambahBukti(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'pelapor' => 'required|string|max:255',
            'bukti' => 'required|file|mimes:jpg,jpeg,png,webp,gif,mp4,mov,avi|max:204800', // 200MB
        ]);

        $file = $request->file('bukti');

        if (!$file || !$file->isValid()) {
            return back()->withErrors(['bukti' => 'Upload file gagal atau file rusak.'])->withInput();
        }

        // Nama file aman
        $original = $file->getClientOriginalName() ?: 'file.bin';
        $safeName = time() . '_' . Str::random(8) . '_' . preg_replace('/\s+/', '_', $original);

        $path = null;

        try {
            // Jika disk public tersedia
            if (Storage::disk('public')->exists('')) {
                $path = Storage::disk('public')->putFileAs('bukti_kasus', $file, $safeName);
            } else {
                // fallback
                $path = $file->store('bukti_kasus', 'public');
            }
        } catch (\Throwable $e) {

            Log::warning('putFileAs/store failed: '.$e->getMessage());

            try {
                $path = $file->store('bukti_kasus', 'public');
            } catch (\Throwable $e2) {

                Log::error('Fallback store failed: '.$e2->getMessage());

                try {
                    // fallback manual terakhir
                    $dest = storage_path('app/public/bukti_kasus');
                    if (!is_dir($dest)) {
                        @mkdir($dest, 0755, true);
                    }

                    $moved = $file->move($dest, $safeName);
                    if ($moved) {
                        $path = 'bukti_kasus/' . $safeName;
                    }
                } catch (\Throwable $e3) {
                    Log::critical('ALL storage methods failed: ' . $e3->getMessage());
                    return back()->withErrors(['bukti' => 'Gagal menyimpan file bukti.'])->withInput();
                }
            }
        }

        if (empty($path)) {
            return back()->withErrors(['bukti' => 'Gagal menyimpan file (path kosong).'])->withInput();
        }

        // Simpan DB
        KasusBukti::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'pelapor' => $request->pelapor,
            'file_path' => $path,
        ]);

        return redirect()->route('kasus.list')->with('success', 'Bukti kasus berhasil ditambahkan!');
    }

    // ===========================
    // HALAMAN DETAIL
    // ===========================
    public function detail($id)
    {
        $kasus = KasusBukti::findOrFail($id);
        return view('kasus.detail', compact('kasus'));
    }

    // ===========================
    // HAPUS KASUS
    // ===========================
    public function delete($id)
    {
        $kasus = KasusBukti::findOrFail($id);

        if ($kasus->file_path && Storage::disk('public')->exists($kasus->file_path)) {
            Storage::disk('public')->delete($kasus->file_path);
        }

        $kasus->delete();

        return redirect()->route('kasus.list')->with('success', 'Bukti berhasil dihapus.');
    }
}
