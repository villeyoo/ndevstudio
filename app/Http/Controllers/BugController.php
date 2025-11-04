<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BugController extends Controller
{
    /**
     * Simpan bug baru.
     */
  public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'dilaporkan_oleh' => 'required|string|max:255',
        'prioritas' => 'required|string|in:Low,Medium,High,Critical',
        'deskripsi' => 'required|string',
        'tanggal' => 'required|date',
        'bukti' => 'required|file|mimes:jpg,jpeg,png,webp,gif,mp4,mov,avi|max:10240',
    ]);

    $file = $request->file('bukti');
    if (! $file || ! $file->isValid()) {
        return back()->withErrors(['bukti' => 'Upload file gagal. Pastikan file dipilih dan tidak rusak.'])->withInput();
    }

    // Buat nama file aman
    $original = $file->getClientOriginalName() ?: 'file.bin';
    $safeName = time() . '_' . Str::random(6) . '_' . preg_replace('/\s+/', '_', $original);

    // 3-strategy: preferred Storage::putFileAs -> fallback Storage::putFile -> fallback move to storage_path
    $path = null;

    try {
        // Pastikan disk 'public' ada dan dapat menulis
        if (Storage::disk('public')->exists('')) {
            // Coba putFileAs (sama dengan storeAs tapi lewat Storage facade)
            $path = Storage::disk('public')->putFileAs('bug_files', $file, $safeName);
        } else {
            // jika disk 'public' tidak terkonfigurasi, fallback ke store()
            $path = $file->store('bug_files', 'public');
        }
    } catch (\Throwable $e) {
        Log::warning('putFileAs/store failed: '.$e->getMessage(), ['exception' => $e->getMessage()]);

        // fallback: coba store (Laravel generate name)
        try {
            $path = $file->store('bug_files', 'public');
        } catch (\Throwable $e2) {
            Log::error('Fallback store failed: '.$e2->getMessage(), ['exception' => $e2->getMessage()]);

            // fallback manual: pindahkan langsung ke storage_path
            try {
                $dest = storage_path('app/public/bug_files');
                if (! is_dir($dest)) {
                    @mkdir($dest, 0755, true);
                }
                $moved = $file->move($dest, $safeName);
                if ($moved) {
                    $path = 'bug_files/' . $safeName;
                }
            } catch (\Throwable $e3) {
                Log::critical('All file store attempts failed: '.$e3->getMessage());
                return back()->withErrors(['bukti' => 'Gagal menyimpan file. Periksa konfigurasi storage/permission.'])->withInput();
            }
        }
    }

    if (empty($path)) {
        return back()->withErrors(['bukti' => 'Gagal menyimpan file (path kosong).'])->withInput();
    }

    // Simpan ke DB (path relatif terhadap storage/app/public)
    \App\Models\Bug::create([
        'judul' => $request->judul,
        'dilaporkan_oleh' => $request->dilaporkan_oleh,
        'prioritas' => $request->prioritas,
        'deskripsi' => $request->deskripsi,
        'tanggal' => $request->tanggal,
        'bukti' => $path,
    ]);

    return redirect()->route('bug.index')->with('success', 'Bug berhasil dilaporkan!');
}
    /**
     * Opsional: Tampilkan daftar bug.
     */
    public function index()
    {
        $bugs = Bug::latest()->get();
        return view('tambahBug', compact('bugs'));
    }

    public function download($id)
{
    $bug = \App\Models\Bug::findOrFail($id);

    // pastikan ada bukti
    if (empty($bug->bukti) || ! Storage::disk('public')->exists($bug->bukti)) {
        return redirect()->back()->with('error', 'File bukti tidak ditemukan.');
    }

    // dapatkan nama file asli (basename) untuk di-download
    $basename = basename($bug->bukti);

    // optional: jika kamu menyimpan nama file asli di DB, gunakan itu
    // $basename = $bug->original_bukti_name ?? basename($bug->bukti);

    // Gunakan Storage::download untuk mengirim header attachment
    return Storage::disk('public')->download($bug->bukti, $basename);
}

}
