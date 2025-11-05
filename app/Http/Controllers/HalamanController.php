<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HalamanController extends Controller
{
    public function about()
    {
        return view('eventDesa'); // menampilkan file about.blade.php
    }
}
