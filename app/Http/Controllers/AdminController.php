<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\ContentCreator;
use App\Models\Scripter;
use App\Models\Polisi;
use App\Models\Bug;   // ✅ Tambahkan model Bug
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use App\Models\Laporan;


class AdminController extends Controller
{
    public function index()
    {
        // Hitung total lowongan & pengajuan
        $totalLowongan      = Lowongan::count();
        $totalContentCreator = ContentCreator::count();
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
    public function daftarLaporan()
    {
        // total semua laporan
        $totalLaporan = Laporan::count();

        // daftar laporan terbaru
        $laporans = Laporan::latest()->take(10)->get();

        return view('daftarlaporan', compact(
            'totalLaporan',
            'laporans'
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
        $totalContentCreator = ContentCreator::count();
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

    public function dashboardNdev()
    {
        // Hitung total lowongan & pengajuan
        $pendingOrders = Order::where('status', 'pending')->count();


        // Kirim semua data ke view
        return view('dashboardNdev', compact(
            'pendingOrders'
        ));
    }
    public function laporanIndex()
    {
        $laporans = Laporan::latest()->get();

        return view('lihatlaporan', compact('laporans'));
    }
    public function laporanDetail($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('detaillaporan', compact('laporan'));
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:PENDING,DIPROSES,SELESAI,DITOLAK'
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->status = $request->status;
        $laporan->save();

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }
    public function deleteLaporan($id)
    {
        $laporan = Laporan::findOrFail($id);

        if ($laporan->attachment && Storage::disk('public')->exists($laporan->attachment)) {
            Storage::disk('public')->delete($laporan->attachment);
        }

        $laporan->delete();

        return back()->with('success', 'Laporan berhasil dihapus.');
    }
    public function laporanByStatus($status)
    {
        $laporans = Laporan::where('status', strtoupper($status))
            ->latest()
            ->get();

        return view('lihatlaporan', compact('laporans'));
    }


    public function tandaiSelesai($id)
    {
        $laporan = Laporan::findOrFail($id);

        $laporan->update([
            'status' => 'SELESAI'
        ]);

        return back()->with('success', 'Laporan berhasil ditandai SELESAI.');
    }
    public function downloadLaporan($id)
{
    $laporan = Laporan::findOrFail($id);

    if (!$laporan->attachment || !Storage::disk('public')->exists($laporan->attachment)) {
        return back()->with('error', 'File attachment tidak ditemukan.');
    }

    // Ambil path file
    $path = storage_path('app/public/' . $laporan->attachment);
    $filename = basename($laporan->attachment);

    return response()->download($path, $filename);
}

}
