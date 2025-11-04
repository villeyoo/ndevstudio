<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\ContentCreator;
use App\Models\Scripter;
use App\Models\Polisi;
use App\Models\Bug;   // ✅ Tambahkan model Bug
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
    public function index()
    {
        // Hitung total lowongan & pengajuan
        $totalLowongan      = Lowongan::count();
        $totalContentCreator= ContentCreator::count();
        $totalPolisi        = Polisi::count();
        $totalScripter      = Scripter::count();

        // ✅ Ambil daftar bug terbaru (misal 10 terakhir)
        $bugs = Bug::latest()->take(10)->get();

        // Kirim semua data ke view
        return view('dashboard', compact(
            'totalLowongan',
            'totalContentCreator',
            'totalPolisi',
            'totalScripter',
            'bugs'          // ✅ kirim ke view
        ));
    }

    public function showScripter()
    {
        $scripters = Scripter::all();
        return view('scripter', compact('scripters'));
    }

    public function adminIndex()
{

     $totalLowongan      = Lowongan::count();
        $totalContentCreator= ContentCreator::count();
        $totalPolisi        = Polisi::count();
        $totalScripter      = Scripter::count();
        $bugs = Bug::latest()->take(10)->get();

    return view('dashboard-admin', compact(
            'totalLowongan',
            'totalContentCreator',
            'totalPolisi',
            'totalScripter',
            'bugs'          // ✅ kirim ke view
        ));
}

    public function showPolisi()
    {
        $polisis = Polisi::all();
        return view('polisi', compact('polisis'));
    }

    public function showContentCreator()
    {
        $contentCreators = ContentCreator::all();
        return view('content-creator', compact('contentCreators'));
    }

 public function deleteBug($id)
{
    // Cari bug
    $bug = Bug::findOrFail($id);

    // Jika ada file bukti dan file-nya benar-benar ada di storage
    if ($bug->bukti && Storage::disk('public')->exists($bug->bukti)) {
        Storage::disk('public')->delete($bug->bukti);
    }

    // Hapus data bug dari database
    $bug->delete();

    return redirect()->back()->with('success', 'Bug dan file buktinya berhasil dihapus.');
}
}
