@extends('layouts.app')

@section('content')
    <div class="p-4">
        <h1 class="text-xl font-bold mb-4">Data Penjualan / Invoice </h1>
        <div class="flex gap-2 justify-end">
            <button id="addNew" type="button" class="btn btn-info mb-3 text-white"><i class="fas fa-plus mr-2"></i> Tambah
                Penjualan</button>
        </div>

        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 p-4 shadow">
            <table id="jualTable" class="table min-w-full text-sm text-left text-gray-600 ">
            </table>
        </div>
    </div>

    @include('juals.partials.modal')

    @push('scripts')
        <script type="module">
            document.addEventListener("DOMContentLoaded", function() {
                $(function() {
                    const table = $('#jualTable').DataTable({
                        ajax: {
                            url: '{{ route('juals.index') }}',
                            dataSrc: function(json) {
                                console.log('AJAX Response:', json);
                                return json.data;
                            }
                        },
                        columns: [{
                                data: 'No_Faktur',
                                title: 'No. Faktur'
                            },
                            {
                                data: 'Tgl_Faktur',
                                title: 'Tanggal Faktur'
                            },
                            {
                                data: 'customer.Nama_Customer',
                                title: 'Nama Customer',
                                defaultContent: '-'
                            },
                            {
                                data: 'jen.Nama_Tjen',
                                title: 'Jenis Transaksi',
                                defaultContent: '-'
                            },
                            {
                                data: 'Total_Bruto',
                                title: 'Total Bruto (IDR)',
                                render: function(data) {
                                    // return new Intl.NumberFormat('id-ID', {
                                    //     style: 'currency',
                                    //     currency: 'IDR'
                                    // }).format(data);
                                    return 'Rp ' + parseFloat(data).toLocaleString()
                                }
                            },
                            {
                                data: 'Total_Diskon',
                                title: 'Total Diskon (IDR)',
                                render: function(data) {
                                    // return new Intl.NumberFormat('id-ID', {
                                    //     style: 'currency',
                                    //     currency: 'IDR'
                                    // }).format(data);
                                    return 'Rp ' + parseFloat(data).toLocaleString()
                                }
                            },
                            {
                                data: 'Total_Jumlah',
                                title: 'Total Jumlah (IDR)',
                                render: function(data) {
                                    // return new Intl.NumberFormat('id-ID', {
                                    //     style: 'currency',
                                    //     currency: 'IDR'
                                    // }).format(data);
                                    return 'Rp ' + parseFloat(data).toLocaleString()
                                }
                            },
                            {
                                data: null,
                                sortable: false,
                                searchable: false,
                                render: function(data) {
                                    return `
                                    <div class="flex gap-2">
                                        <a href="/juals/${data.No_Faktur}/print" target="_blank" class="hidden btn btn-outline btn-warning text-warning">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
                                        <a href="{{ route('juals.export.csv') }}" class="hidden btn btn-outline btn-success text-success">
                                            <i class="fa-solid fa-file-csv"></i>
                                        </a>
                                        <a href="/juals/${data.No_Faktur}/edit" class="btn btn-success text-white edit" data-id="${data.No_Faktur}"><i class="fa-solid fa-pen"></i></a>
                                        <button class="btn btn-error text-white jual-delete" data-id="${data.No_Faktur}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                    `;
                                }
                            }
                        ]
                    });

                    // Tambah Data
                    $('#addNew').click(function() {
                        // console.log('Tambah Penjualan')
                        $('#jualModal').addClass('modal-open');
                        $('#jualForm')[0].reset();
                        $('#modalTitle').text('Tambah Penjualan');
                        // fetch data untuk create -> select
                        // loadSelectData("{{ route('customers.index') }}", '#customersSelect',
                        //     'Pilih Customer', 'Kode_Customer', 'Nama_Customer');
                        // loadSelectData("{{ route('jens.index') }}", '#jensSelect',
                        //     'Pilih Jenis Transaksi', 'Kode_Tjen', 'Nama_Tjen');
                        $.ajax({
                            url: "{{ route('customers.index') }}",
                            type: "GET",
                            success: function(response) {
                                console.log('Customers:', response);
                                $('#customersSelect').empty();
                                $('#customersSelect').append(
                                    '<option value="" disabled >Pilih Customer</option>'
                                );
                                response.data.forEach(customer => {
                                    $('#customersSelect').append(
                                        `<option value="${customer.Kode_Customer}">${customer.Nama_Customer}</option>`
                                    )
                                });
                            }
                        });
                        $.ajax({
                            url: "{{ route('jens.index') }}",
                            type: "GET",
                            success: function(response) {
                                console.log('Jens:', response);
                                $('#jensSelect').empty();
                                $('#jensSelect').append(
                                    '<option value="" disabled >Pilih Jenis Transaksi</option>'
                                );
                                response.data.forEach(jens => {
                                    $('#jensSelect').append(
                                        `<option value="${jens.Kode_Tjen}">${jens.Nama_Tjen}</option>`
                                    )
                                });
                            }
                        });
                    });

                    $(document).on('click', '.jualAlertMessageClose', function() {
                        // $('#jualAlertMessage').addClass('hidden');
                        console.log('Close Alert Message');
                        $('#jualModal').removeClass('modal-open');
                    });

                    // Hapus Data
                    $(document).on('click', '.jual-delete', function(e) {
                        e.preventDefault();
                        const noFaktur = $(this).data('id');

                        if (!confirm('Apakah Anda yakin ingin menghapus penjualan ini?')) {
                            return;
                        }

                        $.ajax({
                            url: `/juals/${noFaktur}`,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                showToast(response.message || 'Penjualan berhasil dihapus',
                                    'success');
                                $('#jualTable').DataTable().ajax.reload();
                            },
                            error: function(xhr) {
                                console.error('Gagal menghapus:', xhr.responseText);
                                showToast(xhr.responseJSON.message ||
                                    'Gagal menghapus penjualan',
                                    'error');
                                // alert('Terjadi kesalahan saat menghapus data');
                            }
                        });
                    });


                    $('.closeJualModal').click(function() {
                        $('#jualModal').removeClass('modal-open');
                    });
                });
            });
        </script>
    @endpush
@endsection
