@extends('layouts.app')

@section('content')
    <div class="max-w-md p-6 mx-auto bg-white border border-gray-200 rounded-lg shadow-md">
        <h1 class="mb-6 text-2xl font-bold text-center text-gray-800">Tambah Customer Baru</h1>

        @if ($errors->any())
            <div class="px-4 py-3 mb-4 text-sm text-red-700 border border-red-200 rounded-md bg-red-50" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul class="mt-2 text-sm list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customers.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="Kode_Customer" class="block mb-1 text-sm font-medium text-gray-700">Kode Customer:</label>
                <input type="text" name="Kode_Customer" id="Kode_Customer"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('Kode_Customer') border-red-500 @enderror"
                    value="{{ old('Kode_Customer') }}" required maxlength="4">
                @error('Kode_Customer')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="Nama_Customer" class="block mb-1 text-sm font-medium text-gray-700">Nama Customer:</label>
                <input type="text" name="Nama_Customer" id="Nama_Customer"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('Nama_Customer') border-red-500 @enderror"
                    value="{{ old('Nama_Customer') }}" required maxlength="40">
                @error('Nama_Customer')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-6 gap-x-3">
                <a href="{{ route('customers.index') }}"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 disabled:opacity-25">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-900 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
                    Simpan Customer
                </button>
            </div>
        </form>
    </div>
@endsection
