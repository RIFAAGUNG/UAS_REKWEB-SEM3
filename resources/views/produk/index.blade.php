@extends('layout')

@section('content')
    <h1>Daftar Produk</h1>
    <a href="{{ route('products.create') }}">Tambah Produk</a>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->nama_produk }}</td>
                <td>{{ $product->kategori }}</td>
                <td>{{ $product->harga }}</td>
                <td>{{ $product->stok }}</td>
                <td>
                    <a href="{{ route('products.show', $product) }}">Lihat</a>
                    <a href="{{ route('products.edit', $product) }}">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection