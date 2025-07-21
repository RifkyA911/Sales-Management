@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit Customer: <span
                class="text-indigo-600">{{ $customer->Nama_Customer }}</span></h1>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md mb-4 text-sm" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customers.update', $customer->Kode_Customer) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="Kode_Customer" class="block text-sm font-medium text-gray-700 mb-1">Kode Customer:</label>
                <input type="text" name="Kode_Customer" id="Kode_Customer"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-600 cursor-not-allowed sm:text-sm"
                    value="{{ $customer->Kode_Customer }}" readonly>
            </div>

            <div>
                <label for="Nama_Customer" class="block text-sm font-medium text-gray-700 mb-1">Nama Customer:</label>
                <input type="text" name="Nama_Customer" id="Nama_Customer"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('Nama_Customer') border-red-500 @enderror"
                    value="{{ old('Nama_Customer', $customer->Nama_Customer) }}" required maxlength="40">
                @error('Nama_Customer')
                    <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-x-3 mt-6">
                <a href="{{ route('customers.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Perbarui Customer
                </button>
            </div>
        </form>
    </div>
@endsection
