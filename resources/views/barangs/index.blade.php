@extends('layouts.app')

@section('content')
    <div class="max-w-6xl p-6 mx-auto bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">Daftar Barang</h1>
            <button class="btn btn-primary btn-sm" onclick="addBarangModal.showModal()">Tambah Barang</button>
        </div>

        @if (session('success'))
            <div role="alert" class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table id="barangTable" class="min-w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Kode Barang</th>
                        <th class="px-4 py-2">Nama Barang</th>
                        <th class="px-4 py-2">Harga Barang</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $barang)
                        <tr id="row-{{ $barang->Kode_Barang }}">
                            <td class="px-4 py-2">{{ $barang->Kode_Barang }}</td>
                            <td class="px-4 py-2">{{ $barang->Nama_Barang }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($barang->Harga_Barang, 2, ',', '.') }}</td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <button class="btn btn-sm btn-warning"
                                    onclick="openEditModal('{{ $barang->Kode_Barang }}', '{{ $barang->Nama_Barang }}', '{{ $barang->Harga_Barang }}')">
                                    Edit
                                </button>
                                <form action="{{ route('barangs.destroy', $barang->Kode_Barang) }}" method="POST"
                                    class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus?')"
                                        class="btn btn-sm btn-error text-white">Hapus</button>
                                </form>
                                {{-- {!! '<script>document.write(renderActionButtons(' . json_encode($barang) . '))</script>' !!} --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <input type="hidden" id="csrfToken" value="{{ csrf_token() }}">
        </div>
    </div>

    @include('barangs.partials.add-modal')
    @include('barangs.partials.edit-modal')

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('#barangTable').DataTable();
            });
        </script>
    @endpush
@endsection
