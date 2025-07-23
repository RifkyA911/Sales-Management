@extends('layouts.app')

@section('content')
    <div class="p-4">
        <h1 class="text-xl font-bold mb-4">Detail Penjualan - Faktur: {{ $jual->No_Faktur }}</h1>

        <button id="addNew" class="btn btn-primary mb-3">Tambah Barang</button>

        <table id="djualTable" class="table w-full">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Diskon</th>
                    <th>Bruto</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    {{-- Modal --}}
    <div id="djualModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg" id="modalTitle">Tambah Detail</h3>
            <form id="djualForm">
                @csrf
                <input type="hidden" name="No_Faktur" value="{{ $jual->No_Faktur }}">
                <div class="form-control">
                    <label class="label">Kode Barang</label>
                    <input type="text" name="Kode_Barang" class="input input-bordered" required>
                </div>
                <div class="form-control">
                    <label class="label">Harga</label>
                    <input type="number" name="Harga" class="input input-bordered" required>
                </div>
                <div class="form-control">
                    <label class="label">Qty</label>
                    <input type="number" name="Qty" class="input input-bordered" required>
                </div>
                <div class="form-control">
                    <label class="label">Diskon</label>
                    <input type="number" name="Diskon" class="input input-bordered" required>
                </div>
                <div class="form-control">
                    <label class="label">Bruto</label>
                    <input type="number" name="Bruto" class="input input-bordered" required>
                </div>
                <div class="form-control">
                    <label class="label">Jumlah</label>
                    <input type="number" name="Jumlah" class="input input-bordered" required>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="#" class="btn" id="closeModal">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = $('#djualTable').DataTable({
                ajax: '{{ route('djuals.index', $jual->No_Faktur) }}',
                columns: [{
                        data: 'Kode_Barang'
                    },
                    {
                        data: 'barang.Nama_Barang'
                    },
                    {
                        data: 'Harga'
                    },
                    {
                        data: 'Qty'
                    },
                    {
                        data: 'Diskon'
                    },
                    {
                        data: 'Bruto'
                    },
                    {
                        data: 'Jumlah'
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `
                        <button class="btn btn-xs btn-primary edit" data-id="${data.Kode_Barang}">Edit</button>
                        <button class="btn btn-xs btn-error delete" data-id="${data.Kode_Barang}">Hapus</button>
                    `;
                        }
                    }
                ]
            });

            $('#addNew').click(function() {
                $('#djualForm')[0].reset();
                $('#modalTitle').text('Tambah Detail');
                $('#djualModal').show();
            });

            $('#closeModal').click(function() {
                $('#djualModal').hide();
            });

            $('#djualForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('djuals.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function() {
                        $('#djualModal').hide();
                        table.ajax.reload();
                    }
                });
            });
        });
    </script>
@endpush
