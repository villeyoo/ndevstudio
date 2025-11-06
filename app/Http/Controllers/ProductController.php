<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Tampilkan halaman tambah Robux
     */
    public function create()
    {
        return view('tambahRobux');
    }

    /**
     * Tampilkan daftar Robux
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('listRobux', compact('products'));
    }

    /**
     * Simpan data Robux baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'type'  => 'nullable|string|max:255',
        ]);

        Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'type'  => $request->type,
        ]);

        return redirect()
            ->route('product.create')
            ->with('success', 'Data Robux berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit Robux
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('editRobux', compact('product'));
    }

    /**
     * Update data Robux
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'type'  => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'title' => $request->title,
            'price' => $request->price,
            'type'  => $request->type,
        ]);

        return redirect()
            ->route('product.index')
            ->with('success', 'Data Robux berhasil diperbarui!');
    }

    /**
     * Hapus data Robux
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('product.index')
            ->with('success', 'Data Robux berhasil dihapus!');
    }
}
