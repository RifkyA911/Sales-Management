@extends('layouts.app') {{-- Menggunakan layout yang baru dibuat --}}

@section('content')
    <div class="max-w-4xl p-6 mx-auto bg-white border border-gray-200 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Customer</h1>
            <a href="{{ route('customers.create') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-900 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Customer Baru
            </a>
            <!-- Modal Tambah/Edit Customer -->
            @include('customers.partials.modal')
        </div>

        @if (session('success'))
            <div class="px-4 py-3 mb-4 text-sm text-green-700 border border-green-200 rounded-md bg-green-50"
                role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="px-4 py-3 mb-4 text-sm text-red-700 border border-red-200 rounded-md bg-red-50" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($customers->isEmpty())
            <p class="py-8 text-center text-gray-600">Tidak ada data customer yang ditemukan.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Kode Customer
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Nama Customer
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($customers as $customer)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                    {{ $customer->Kode_Customer }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $customer->Nama_Customer }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                    <a href="{{ route('customers.edit', $customer->Kode_Customer) }}"
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 shadow-sm">
                                        Edit
                                    </a>
                                    {{-- <form action="{{ route('customers.destroy', $customer->Kode_Customer) }}" method="POST"
                                        class="inline-block ml-2"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus customer ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 shadow-sm">
                                            Hapus
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @endif
    </div>
@endsection
