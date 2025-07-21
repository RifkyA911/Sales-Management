@extends('layouts.app')

@section('content')
    <div class="max-w-lg p-6 mx-auto bg-white rounded-lg shadow-md">
        <h1 class="mb-4 text-xl font-bold">Detail Barang</h1>
        <p><strong>Kode Barang:</strong> {{ $barang->Kode_Barang }}</p>
        <p><strong>Nama Barang:</strong> {{ $barang->Nama_Barang }}</p>
        <p><strong>Harga Barang:</strong> Rp {{ number_format($barang->Harga_Barang, 2, ',', '.') }}</p>

        <div class="mt-4">
            <a href="{{ route('barangs.index') }}" class="btn">Kembali</a>
            <a href="{{ route('barangs.edit', $barang->Kode_Barang) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
@endsection
