<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        // Mengambil semua data produk
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        // Menampilkan form untuk membuat produk baru
        return view('produk.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        // Menyimpan produk baru
        Produk::create($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        // Menampilkan detail produk
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        // Menampilkan form untuk mengedit produk
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        // Memperbarui data produk
        $produk->update($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        // Menghapus produk
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}