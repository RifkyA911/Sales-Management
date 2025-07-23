@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 w-[1280px] mx-auto mt-4">
        {{-- HEADER --}}
        <div id="jualHeader" class="p-4 bg-white rounded-lg shadow-lg sm:p-6 relative">
            <div class="flex gap-4 items-center mb-4">
                <i class="fa-solid fa-money-bill-wave text-xl"></i>
                <h2 class="font-bold text-xl">
                    Header Penjualan /
                    Invoice</h2>
            </div>

            {{-- HEADER --}}
            <div class="grid grid-cols-2 gap-4">
                <!-- Kolom 1 -->
                <div class="">
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">No. Faktur</legend>
                        <input type="text" name="No_Faktur" id="No_Faktur" class="input w-full"
                            placeholder="Masukkan No Faktur" required maxlength="20" readonly
                            value="{{ $jual->No_Faktur }}">
                        <p class="mt-1 text-sm text-red-500" id="error_No_Faktur"></p>
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Kode Customer</legend>
                        <select class="select w-full" id="customersSelect" name="Kode_Customer" required disabled
                            value="{{ $jual->Kode_Customer }}">
                            <option value="" disabled selected>Pilih Customer</option>
                        </select>
                        <p class="mt-1 text-sm text-red-500" id="error_Kode_Customer"></p>
                    </fieldset>
                </div>

                <!-- Kolom 2 -->
                <div class="">
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Tanggal Faktur</legend>
                        <input type="date" class="input w-full" name="Tgl_Faktur" readonly
                            value="{{ $jual->Tgl_Faktur }}" />
                        <p class="mt-1 text-sm text-red-500" id="error_Tgl_Faktur"></p>
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Jenis Transaksi</legend>
                        <select class="select w-full" id="jensSelect" name="Kode_Tjen" required disabled
                            value="{{ $jual->Kode_Tjen }}">
                            <option value="" disabled selected>Pilih Jenis Transaksi</option>
                        </select>
                        <p class="mt-1 text-sm text-red-500" id="error_Kode_Tjen"></p>
                    </fieldset>
                </div>
            </div>

            <hr class="my-4 border-gray-200" />

            {{-- DETAIL --}}
            <div class="flex gap-4 items-center mb-4">
                <i class="fa-solid fa-file-invoice text-xl"></i>
                <h2 class="font-bold text-xl">
                    Detail Penjualan /
                    Invoice</h2>
            </div>
            <form id="jualDetailForm" class="">
                @csrf
                <div class="grid grid-cols-12 gap-4">
                    <fieldset class="fieldset col-span-2">
                        <legend class="fieldset-legend">Kode Barang</legend>
                        <select class="select " id="Kode_Barang" name="Kode_Barang" required>
                            <option value="" disabled selected>Pilih Barang</option>
                        </select>
                        <p class="mt-1 text-sm text-red-500" id="error_Kode_Barang"></p>
                    </fieldset>
                    <fieldset class="fieldset  col-span-2">
                        <legend class="fieldset-legend">Nama Barang</legend>
                        <select class="select " id="Nama_Barang" name="Nama_Barang" required>
                            <option value="" disabled selected>Pilih Barang</option>
                        </select>
                        <p class="mt-1 text-sm text-red-500" id="error_Nama_Barang"></p>
                    </fieldset>
                    <fieldset class="fieldset  col-span-2">
                        <legend class="fieldset-legend">Harga Barang (IDR)</legend>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3  z-1">
                                <span class="font-medium">Rp.</span>
                            </div>
                            <input type="text" name="Harga" id="Harga" class="input pl-10"
                                placeholder="Masukkan Harga" required step="0.01" min="0" readonly>
                        </div>
                        <p class="mt-1 text-sm text-red-500" id="error_Harga"></p>
                    </fieldset>
                    <fieldset class="fieldset  col-span-1">
                        <legend class="fieldset-legend">QTY</legend>
                        <input type="text" name="Qty" id="Qty" class="input " placeholder="Qty" required
                            step="0.01" min="0" disabled>
                        <p class="mt-1 text-sm text-red-500" id="error_Qty"></p>
                    </fieldset>
                    <fieldset class="fieldset  col-span-1">
                        <legend class="fieldset-legend">Diskon %</legend>
                        <input type="text" name="Diskon" id="Diskon" class="input " placeholder="Diskon" required
                            step="0.01" min="0" disabled>
                        <p class="mt-1 text-sm text-red-500" id="error_Diskon"></p>
                    </fieldset>
                    <fieldset class="fieldset  col-span-2">
                        <legend class="fieldset-legend">Bruto (IDR)</legend>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3  z-1">
                                <span class="font-medium">Rp.</span>
                            </div>
                            <input type="text" name="Bruto" id="Bruto" class="input pl-10"
                                placeholder="Masukkan Bruto" required step="0.01" min="0" readonly>
                        </div>
                        <p class="mt-1 text-sm text-red-500" id="error_Bruto"></p>
                    </fieldset>
                    <fieldset class="fieldset  col-span-2">
                        <legend class="fieldset-legend">Jumlah (IDR)</legend>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3  z-1">
                                <span class="font-medium">Rp.</span>
                            </div>
                            <input type="text" name="Jumlah" id="Jumlah" class="input pl-10"
                                placeholder="Masukkan Jumlah" required step="0.01" min="0" readonly>
                        </div>
                        <p class="mt-1 text-sm text-red-500" id="error_Jumlah"></p>
                    </fieldset>
                </div>
                <div class="flex gap-2 justify-end mt-4">
                    <button id="addJualDetail" type="submit" class="btn btn-info mb-3 text-white"><i
                            class="fa-solid fa-floppy-disk mr-2"></i> Simpan
                        Barang</button>
                </div>
            </form>
            <hr class="my-8 border-gray-200" />

            <div class="flex gap-4 items-center mb-4">
                <i class="fa-solid fa-table text-xl"></i>
                <h2 class="font-bold text-xl">
                    Daftar Barang Penjualan /
                    Invoice</h2>
            </div>
            <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 p-4">

                <table id="jualDetailTable" class="table min-w-full text-sm text-left text-gray-600">
                </table>
            </div>


            <hr class="my-8 border-gray-200" />
            <div class="flex flex-col gap-2 md:w-1/2 md:ml-auto">
                <div class="flex justify-between items-center">
                    <h5 class="font-bold">Total Bruto</h5>
                    <input type="text" readonly class="input text-right font-bold"
                        value="{{ 'Rp ' . number_format($jual->Total_Bruto, 2, ',', '.') }}">
                </div>
                <div class="flex justify-between items-center">
                    <h5 class="font-bold">Total Diskon</h5>
                    <input type="text" readonly class="input text-right font-bold"
                        value="{{ 'Rp ' . number_format($jual->Total_Diskon, 2, ',', '.') }}">
                </div>
                <div class="flex justify-between items-center">
                    <h5 class="font-bold">Total Jumlah</h5>
                    <input type="text" readonly class="input text-right font-bold"
                        value="{{ 'Rp ' . number_format($jual->Total_Jumlah, 2, ',', '.') }}">
                </div>
            </div>
        </div>

        {{-- TABEL --}}
    </div>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // ------------------------------------- Data Entry -------------------------------------
                $.ajax({
                    url: "{{ route('customers.index') }}",
                    type: "GET",
                    success: function(response) {
                        // console.log('Customers:', response);
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
                        // console.log('Jens:', response);
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
                $.ajax({
                    url: "{{ route('barangs.index') }}",
                    method: 'GET',
                    success: function(response) {
                        // console.log('Barangs:', response);

                        response.data.forEach(function(barang) {
                            $('#Kode_Barang').append(
                                `<option value="${barang.Kode_Barang}">${barang.Kode_Barang}</option>`
                            );
                            $('#Nama_Barang').append(
                                `<option value="${barang.Nama_Barang}" data-kode-barang="${barang.Kode_Barang}">${barang.Nama_Barang}</option>`
                            );
                        });
                    }
                });

                $('#Kode_Barang').on('change', function() {
                    const selectedValue = $(this).val();
                    $('#Jumlah').val('0');
                    $('#Bruto').val('0');

                    $.ajax(`{{ route('barangs.show', ':kode_barang') }}`.replace(':kode_barang',
                            selectedValue))
                        .then(response => {
                            // console.log("Harga Barang:", response.data.Harga);
                            $('#Qty').removeAttr('disabled', false);
                            $('#Diskon').removeAttr('disabled', false);
                            $('#Qty').val('0');
                            $('#Diskon').val('0');
                            $('#Nama_Barang').val(response.data.Nama_Barang);
                            return $('#Harga').val(response.data.Harga_Barang);
                        })
                        .catch(error => {
                            console.error("Error fetching harga:", error);
                            $('#Qty').attr('disabled', true);
                            $('#Diskon').attr('disabled', true);
                            $('#Qty').val('0');
                            $('#Diskon').val('0');
                            return 0; // Default value if error occurs
                        });
                })

                $('#Nama_Barang').on('change', function() {
                    const selectedOption = $(this).find('option:selected');
                    const kodeBarang = selectedOption.data('kode-barang');
                    // console.log("Selected Nama-Kode Barang:", kodeBarang);
                    $('#Kode_Barang').val(kodeBarang);
                    $('#Jumlah').val('0');
                    $('#Bruto').val('0');

                    $.ajax(`{{ route('barangs.show', ':kode_barang') }}`.replace(':kode_barang',
                            kodeBarang))
                        .then(response => {
                            // console.log("Harga Barang:", response.data.Harga);
                            $('#Qty').removeAttr('disabled', false);
                            $('#Diskon').removeAttr('disabled', false);
                            $('#Qty').val('0');
                            $('#Diskon').val('0');
                            return $('#Harga').val(response.data.Harga_Barang);
                        })
                        .catch(error => {
                            console.error("Error fetching harga:", error);
                            $('#Qty').attr('disabled', true);
                            $('#Diskon').attr('disabled', true);
                            $('#Qty').val('0');
                            $('#Diskon').val('0');

                            return 0;
                        });
                });

                $('#Qty').on('input', function() {
                    let value = $(this).val();

                    value = value.replace(/[^0-9.]/g, '');

                    if (value.length > 1 && value.startsWith('0') && !value.startsWith('0.')) {
                        value = value.replace(/^0+/, '');
                    } else if (value === '') {
                        value = '0';
                    }

                    $(this).val(value);

                    const harga = parseFloat($('#Harga').val()) || 0;
                    const diskon = parseFloat($('#Diskon').val()) || 0;
                    const qty = parseFloat(value) || 0;

                    const bruto = harga * qty; // nilai kotor
                    $('#Bruto').val(bruto.toFixed(2));
                    const netto = bruto - (bruto * (diskon / 100)); // nilai bersih
                    $('#Jumlah').val(netto.toFixed(2));
                });



                $('#Diskon').on('input', function() {
                    let value = $(this).val();

                    value = value.replace(/[^0-9.]/g, '');

                    if (value.length > 1 && value.startsWith('0') && !value.startsWith('0.')) {
                        value = value.replace(/^0+/, '');
                    } else if (value === '') {
                        value = '0';
                    }

                    $(this).val(value);

                    const harga = parseFloat($('#Harga').val()) || 0;
                    const diskon = parseFloat(value) || 0;
                    const qty = parseFloat($('#Qty').val()) || 0;

                    const bruto = harga * qty; // nilai kotor
                    $('#Bruto').val(bruto.toFixed(2));
                    const netto = bruto - (bruto * (diskon / 100)); // nilai bersih
                    $('#Jumlah').val(netto.toFixed(2));
                });

                $('#jualDetailForm').submit(function(e) {
                    e.preventDefault();

                    console.log("Form is being submitted");

                    const formData = $(this).serializeArray();
                    formData.push({
                        name: 'No_Faktur',
                        value: '{{ $jual->No_Faktur }}'
                    });

                    $.ajax({
                        url: "{{ route('djuals.store') }}",
                        type: "POST",
                        data: formData,
                        success: function(response) {
                            // console.log('Response:', response);
                            $('#jualDetailTable').DataTable().ajax.reload();
                            $('#jualDetailForm')[0].reset();
                            $('#Kode_Barang').empty();
                            $('#Nama_Barang').empty();
                            $('#Kode_Barang').append(
                                '<option value="" disabled selected>Pilih Barang</option>');
                            $('#Nama_Barang').append(
                                '<option value="" disabled selected>Pilih Barang</option>');
                            showToast('Penjualan berhasil diupdate!', 'success');
                        },
                        error: function(error) {
                            // console.error('Error:', error);
                            const errors = error.responseJSON.errors;
                            for (const key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    $(`#error_${key}`).text(errors[key][0]);
                                }
                            }
                        }
                    });
                });

                // ------------------------------------- Table Jual Detail -------------------------------------

                const table = $('#jualDetailTable').DataTable({
                    ajax: {
                        url: '{{ route('djuals.index', ['no_faktur' => $jual->No_Faktur]) }}',
                        dataSrc: function(json) {
                            // console.log('jualDetailTable:', json);
                            return json.data;
                        }
                    },
                    columns: [
                        // {
                        //     data: 'No_Faktur',
                        //     title: 'No Faktur'
                        // },
                        {
                            data: 'Kode_Barang',
                            title: 'Kode Barang'
                        },
                        {
                            data: 'barang.Nama_Barang',
                            title: 'Nama Barang'
                        },
                        {
                            data: 'Harga',
                            title: 'Harga (IDR)',
                            render: function(data) {
                                return 'Rp ' + parseFloat(data).toLocaleString();
                            }
                        },
                        {
                            data: 'Qty',
                            title: 'QTY'
                        },
                        {
                            data: 'Diskon',
                            title: 'Diskon  %',
                        },
                        {
                            data: 'Bruto',
                            title: 'Bruto (IDR)',
                            render: function(data) {
                                return 'Rp ' + parseFloat(data).toLocaleString();
                            }
                        },
                        {
                            data: 'Jumlah',
                            title: 'Jumlah (IDR)',
                            render: function(data) {
                                return 'Rp ' + parseFloat(data).toLocaleString();
                            }
                        },
                        {
                            data: null,
                            sortable: false,
                            searchable: false,
                            title: 'Aksi',
                            render: function(data) {
                                return `
                                    <div class="flex gap-2">
                                        <button class="btn btn-success text-white edit" data-id="${data.Kode_Barang}"><i class="fa-solid fa-pen"></i></button>
                                        <form action="/djuals/${data.No_Faktur}/${data.Kode_Barang}" method="POST" class="inline-block ml-2"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error text-white delete" data-id="${data.Kode_Barang}"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                    `;
                            }
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
