@extends('layouts.app')

@section('content')
    <div class="max-w-4xl p-6 mx-auto bg-white border border-gray-200 rounded-lg shadow-md">
        <h1 class="mb-6 text-3xl font-bold text-gray-800">Detail Customer</h1>

        <div class="mb-4">
            <strong>Kode Customer:</strong> {{ $customer->Kode_Customer }}
        </div>
        <div class="mb-4">
            <strong>Nama Customer:</strong> {{ $customer->Nama_Customer }}
        </div>

        <div class="flex justify-end mt-6 gap-x-3">
            <a href="{{ route('customers.index') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 disabled:opacity-25">
                Kembali ke Daftar
            </a>
            <a href="{{ route('customers.edit', $customer->Kode_Customer) }}"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-900 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
                Edit Customer
            </a>
        </div>
    </div>
@endsection
