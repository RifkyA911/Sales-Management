@extends('layouts.app')

@section('content')
    <div class="max-w-lg p-6 mx-auto bg-white rounded-lg shadow-md">
        <h1 class="mb-4 text-xl font-bold">Edit Barang</h1>
        <form action="{{ route('barangs.update', $barang->Kode_Barang) }}" method="POST">
            @csrf
            @method('PUT')
            @include('barangs.form')
            <div class="mt-4">
                <a href="{{ route('barangs.index') }}" class="btn">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
