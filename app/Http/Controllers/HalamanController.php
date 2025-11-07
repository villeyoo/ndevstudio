<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HalamanController extends Controller
{
    public function about()
    {
        return view('eventDesa'); // menampilkan file about.blade.php
    }

    public function robux()
    {
        $products = Product::all(); // ambil semua data dari tabel products
        return view('robux', compact('products'));
    }
     public function news()
    {
        return view('news');
    }

     public function success()
    {
        $products = Product::all(); // ambil semua data dari tabel products
        return view('success', compact('products'));
    }
}
