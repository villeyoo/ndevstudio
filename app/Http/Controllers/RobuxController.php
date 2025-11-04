<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestRobux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RobuxController extends Controller
{
    // Staff: tampilkan form - handled by blade mintaRobux (route returns view)
    // (Tidak perlu method showForm karena route->view digunakan)

    // Staff: proses request robux
    public function requestRobux(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        $requestedBy = Auth::check() ? Auth::user()->username : 'guest';

        $record = RequestRobux::create([
            'username' => $request->username,
            'requested_by' => $requestedBy,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Request Robux untuk ' . e($record->username) . ' berhasil dikirim.');
    }

    // Owner: list semua request
public function index()
{
    $requests = RequestRobux::latest()->get();
    return view('permintaanRobux', compact('requests'));
}


    // Owner: form verifikasi (menampilkan blade verifyRobux)
   public function verifyForm($id)
{
    $req = \App\Models\RequestRobux::findOrFail($id);
    return view('verifyRobux', compact('req'));
}


    // Owner: simpan hasil verifikasi
    public function updateVerification(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,verified,rejected',
            'notes' => 'nullable|string|max:1000',
        ]);

        $r = RequestRobux::findOrFail($id);
        $r->status = $request->status;
        $r->notes = $request->notes;
        $r->save();

        return redirect()->route('robux.index')->with('success', 'Status permintaan berhasil diperbarui!');
    }

    // Owner: hapus request
    public function destroy($id)
    {
        RequestRobux::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Request berhasil dihapus.');
    }
    public function trackForm()
{
    // tampilkan form kosong
    return view('trackRobux');
}

public function track(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255',
    ]);

    $username = trim($request->username);

    // ambil record terbaru untuk username tersebut
    $result = RequestRobux::where('username', $username)
                ->orderBy('created_at', 'desc')
                ->first();

    if (! $result) {
        return redirect()->back()->with('error', 'Tidak ditemukan permintaan untuk username tersebut.')->withInput();
    }

    // tampilkan view yang sama dengan hasil (view menerima $result dan optional $searched)
    return view('trackRobux', [
        'result' => $result,
        'searched' => $username,
    ]);
}
}
