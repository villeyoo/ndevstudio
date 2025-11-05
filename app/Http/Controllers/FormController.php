<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission; // model yang akan dibuat di langkah selanjutnya

class FormController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'discord_username' => 'required|string|max:50',
            'video_link' => 'required|url|max:255',
        ]);

        Submission::create($validated);

        return back()->with('success', 'Data berhasil dikirim!');
    }
}
