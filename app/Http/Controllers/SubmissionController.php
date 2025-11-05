<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionController extends Controller
{
    /**
     * Menampilkan daftar semua peserta event.
     */
    public function index()
    {
        $submissions = Submission::latest()->paginate(20);
        return view('event-list', compact('submissions'));
    }

    /**
     * Menghapus satu data submission.
     */
    public function destroy($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->delete();

        return redirect()->route('submissions.index')->with('success', 'Data berhasil dihapus.');
    }
}
