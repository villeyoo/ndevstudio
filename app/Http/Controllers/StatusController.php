<?php

namespace App\Http\Controllers;

use App\Models\ContentCreator;
use App\Models\Polisi;
use App\Models\Scripter;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    // Menampilkan form cek status
    public function showForm()
    {
        return view('cek-status');
    }

    // Memeriksa status pendaftaran berdasarkan username Discord
    public function checkStatus(Request $request)
    {
        // Validasi input
        $request->validate([
            'discord' => 'required|string',
        ]);

        $discord = $request->discord; // Mendapatkan username Discord dari input form

        // Mencari di Content Creator
        $contentCreator = ContentCreator::where('discord', $discord)->first();
        // Mencari di Polisi
        $polisi = Polisi::where('discord', $discord)->first();
        // Mencari di Scripter
        $scripter = Scripter::where('discord', $discord)->first();

        // Cek apakah ada pendaftar
        if ($contentCreator) {
            return view('cek-status', [
                'status' => $contentCreator->status, 
                'role' => 'Content Creator',
                'discord' => $discord
            ]);
        } elseif ($polisi) {
            return view('cek-status', [
                'status' => $polisi->status, 
                'role' => 'Polisi',
                'discord' => $discord
            ]);
        } elseif ($scripter) {
            return view('cek-status', [
                'status' => $scripter->status, 
                'role' => 'Scripter',
                'discord' => $discord
            ]);
        }

        return redirect()->route('cek-status.form')->with('error', 'Username Discord tidak ditemukan.');
    }
}   
