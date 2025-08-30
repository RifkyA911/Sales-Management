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
            <form id="jualForm">
                @csrf
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
                            <input type="date" class="input w-full" id="Tgl_Faktur" name="Tgl_Faktur" readonly
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
                    <div class="hidden">
                        <input type="hidden" name="Total_Bruto" id="Header_Total_Bruto" value="{{ $jual->Total_Bruto }}">
                        <input type="hidden" name="Total_Diskon" id="Header_Total_Diskon"
                            value="{{ $jual->Total_Diskon }}">
                        <input type="hidden" name="Total_Jumlah" id="Header_Total_Jumlah"
                            value="{{ $jual->Total_Jumlah }}">
                    </div>
                </div>
                <div class="flex justify-end gap-4 mt-4">
                    <button type="button" id="JualBtnFormSubmitCancel" class="btn hidden mt-4"><i
                            class="fa-solid fa-database mr-2"></i>
                        Batal</button>
                    <button type="button" id="JualBtnFormSubmit" class="btn btn-accent text-white mt-4"><i
                            class="fa-solid fa-database mr-2"></i>
                        Edit</button>
                    <button type="submit" id="JualBtnFormSubmit_True" class="btn btn-info hidden text-white mt-4"><i
                            class="fa-solid fa-database mr-2"></i>
                        Simpan</button>
                </div>
            </form>

            <hr class="my-4 border-gray-200" />

            {{-- DETAIL --}}
            <div id="jualDetailSection" class="flex gap-4 items-center mb-4">
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
                        <input type="text" name="Diskon" id="Diskon" class="input " placeholder="Diskon"
                            required step="0.01" min="0" disabled>
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

            <div class="flex gap-4 items-center mb-4 justify-between">
                <div class="flex gap-4 items-center">
                    <i class="fa-solid fa-table text-xl"></i>
                    <h2 class="font-bold text-xl">
                        Daftar Barang Penjualan /
                        Invoice</h2>
                </div>
                <div class="flex gap-4">
                    <div class="flex gap-4">
                        <a href="{{ route('juals.print', $jual->No_Faktur) }}" target="_blank" class="btn">
                            <i class="fa-solid fa-print mr-2"></i> Preview & Print PDF
                        </a>
                        <a href="{{ route('djuals.export.csv', ['no_faktur' => $jual->No_Faktur]) }}"
                            class="btn btn-soft btn-success mb-3">
                            <i class="fa-solid fa-file-csv mr-2"></i>
                            Export CSV
                        </a>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 p-4">

                <table id="jualDetailTable" class="table min-w-full text-sm text-left text-gray-600">
                </table>
            </div>


            <hr class="my-8 border-gray-200" />
            <div class="flex flex-col gap-2 md:w-1/2 md:ml-auto">
                <div class="flex justify-between items-center">
                    <h5 class="font-bold">Total Bruto (IDR)</h5>
                    <input id="Total_Bruto" type="text" readonly class="input text-right font-bold"
                        value="{{ $jual->Total_Bruto }}">
                </div>
                <div class="flex justify-between items-center">
                    <h5 class="font-bold">Total Diskon (IDR)</h5>
                    <input id="Total_Diskon" type="text" readonly class="input text-right font-bold"
                        value="{{ $jual->Total_Diskon }}">
                </div>
                <div class="flex justify-between items-center">
                    <h5 class="font-bold">Total Jumlah (IDR)</h5>
                    <input id="Total_Jumlah" type="text" readonly class="input text-right font-bold"
                        value="{{ $jual->Total_Jumlah }}">
                </div>
            </div>
        </div>

        {{-- TABEL --}}
    </div>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('#JualBtnFormSubmit').on('click', function() {
                    $('#No_Faktur').removeAttr('readonly');
                    $('#customersSelect').removeAttr('disabled');
                    $('#Tgl_Faktur').removeAttr('readonly', );
                    $('#jensSelect').removeAttr('disabled');

                    $('#JualBtnFormSubmitCancel').removeClass('hidden');
                    $('#JualBtnFormSubmit').addClass('hidden');
                    $('#JualBtnFormSubmit_True').removeClass('hidden');
                });


                function hideJualFormButton() {
                    $('#No_Faktur').attr('readonly', true);
                    $('#customersSelect').attr('disabled', true);
                    $('#Tgl_Faktur').attr('readonly', true);
                    $('#jensSelect').attr('disabled', true);
                    $('#JualBtnFormSubmitCancel').addClass('hidden');
                    $('#JualBtnFormSubmit').removeClass('hidden');
                    $('#JualBtnFormSubmit_True').addClass('hidden');
                }
                $('#JualBtnFormSubmitCancel').on('click', function() {
                    hideJualFormButton()
                });

                $('#jualForm').on('submit', function(e) {
                    e.preventDefault();
                    console.log('jualForm data:', $(this).serialize());
                    $.ajax({
                        url: "{{ route('juals.update', $jual->No_Faktur) }}",
                        type: "PUT",
                        data: $(this).serialize(),
                        success: async function(response) {
                            console.log("Update Success:", response);
                            hideJualFormButton()
                            showToast('Data berhasil diperbarui', 'success');
                            setTimeout(function() {
                                window.location.href =
                                    `/juals/${$('#No_Faktur').val()}/edit`;
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            console.error("Update Error:", xhr.responseText);
                            alert("Gagal memperbarui data. Silakan coba lagi.");
                        }
                    });

                });

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
                            const selected = customer.Kode_Customer ===
                                "{{ $jual->Kode_Customer }}" ? 'selected' : '';
                            $('#customersSelect').append(
                                `<option value="${customer.Kode_Customer}" ${selected}>${customer.Nama_Customer}</option>`
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
                            const selected = jens.Kode_Tjen === "{{ $jual->Kode_Tjen }}" ?
                                'selected' : '';
                            $('#jensSelect').append(
                                `<option value="${jens.Kode_Tjen}" ${selected}>${jens.Nama_Tjen}</option>`
                            )
                        });
                    }
                });

                function updateBarangDropdown(barangs) {
                    $('#Kode_Barang').empty().append(
                        '<option value="" disabled selected>Pilih Barang</option>');
                    $('#Nama_Barang').empty().append(
                        '<option value="" disabled selected>Pilih Barang</option>');

                    barangs.forEach(barang => {
                        $('#Kode_Barang').append(
                            `<option value="${barang.Kode_Barang}">${barang.Kode_Barang}</option>`
                        );
                        $('#Nama_Barang').append(
                            `<option value="${barang.Nama_Barang}" data-kode-barang="${barang.Kode_Barang}">${barang.Nama_Barang}</option>`
                        );
                    });
                }


                function loadAvailableBarangs() {
                    $.ajax(`/djuals/{{ $jual->No_Faktur }}/available-barangs`)
                        .then(response => updateBarangDropdown(response));
                }
                loadAvailableBarangs();


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
                            return $('#Harga').val(parseFloat(response.data.Harga_Barang).toLocaleString());
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
                            return $('#Harga').val(parseFloat(response.data.Harga_Barang).toLocaleString());
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

                    const harga = parseFloat($('#Harga').val().replace(/,/g, '')) || 0;
                    const diskon = parseFloat($('#Diskon').val()) || 0;
                    const qty = parseFloat(value) || 0;

                    const bruto = harga * qty; // nilai kotor
                    const netto = bruto - (bruto * (diskon / 100)); // nilai bersih
                    $('#Bruto').val(bruto.toLocaleString());

                    $('#Jumlah').val(netto.toLocaleString());

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

                    const harga = parseFloat($('#Harga').val().replace(/,/g, '')) || 0;
                    const diskon = parseFloat(value) || 0;
                    const qty = parseFloat($('#Qty').val()) || 0;

                    const bruto = harga * qty; // nilai kotor
                    const netto = bruto - (bruto * (diskon / 100)); // nilai bersih
                    // $('#Bruto').val(bruto.toFixed(2));
                    // $('#Jumlah').val(netto.toFixed(2));
                    $('#Bruto').val(bruto.toLocaleString());

                    $('#Jumlah').val(netto.toLocaleString());

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
                            render: function(data, type, row) {
                                const bruto = parseFloat(row.Bruto);
                                const diskonPersen = parseFloat(data);
                                const diskonRp = bruto * diskonPersen / 100;

                                return data + ' % (Rp ' + diskonRp.toLocaleString() + ')';
                            }
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
                                        <button class="btn btn-success text-white djual-edit" data-id="${data.Kode_Barang}" data-nama-barang="${data.barang.Nama_Barang}"><i class="fa-solid fa-pen"></i></button>
                                        <form action="/djuals/${data.No_Faktur}/${data.Kode_Barang}"
                                            method="POST"
                                            class="delete-djual-form inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error text-white delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    `;
                            }
                        }
                    ],
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     'csvHtml5'
                    // ]
                });

                let editMode = false;
                let editUrl = '';

                // button untuk mengedit barang detail penjualan
                $(document).on('click', '.djual-edit', function() {
                    const kodeBarang = $(this).data('id');
                    const namaBarang = $(this).data('nama-barang');

                    $.ajax(`{{ route('djuals.edit', [':no_faktur', ':kode_barang']) }}`
                            .replace(':no_faktur', '{{ $jual->No_Faktur }}')
                            .replace(':kode_barang', kodeBarang))
                        .then(response => {
                            console.log("Edit Response:", response);
                            // Isi form
                            $('html, body').animate({
                                scrollTop: $('#jualDetailSection').offset().top
                            }, 500);

                            $('#Kode_Barang').empty().append(
                                `<option value="${response.data.Kode_Barang}">${response.data.Kode_Barang}</option>`
                            ).prop('disabled', true);
                            // disabled tidak dianggap sebagai payload
                            if ($('#Kode_Barang_hidden').length === 0) {
                                $('<input>').attr({
                                    type: 'hidden',
                                    id: 'Kode_Barang_hidden',
                                    name: 'Kode_Barang'
                                }).appendTo('#jualDetailForm');
                            }
                            $('#Kode_Barang_hidden').val(response.data.Kode_Barang);

                            $('#Nama_Barang').empty().append(
                                `<option value="${namaBarang}" selected>${namaBarang}</option>`
                            ).prop('disabled', true);
                            $('#Harga').val(parseFloat(response.data.Harga).toLocaleString());
                            $('#Qty').val(response.data.Qty).removeAttr('disabled');
                            $('#Diskon').val(response.data.Diskon).removeAttr('disabled');
                            $('#Bruto').val(parseFloat(response.data.Bruto).toLocaleString());
                            $('#Jumlah').val(parseFloat(response.data.Jumlah).toLocaleString());

                            // Ubah ke mode edit
                            editMode = true;
                            editUrl = `{{ route('djuals.update', [':no_faktur', ':kode_barang']) }}`
                                .replace(':no_faktur', '{{ $jual->No_Faktur }}')
                                .replace(':kode_barang', kodeBarang);

                            $('#addJualDetail')
                                .removeClass('btn-info')
                                .addClass('btn-warning')
                                .html('<i class="fa-solid fa-pen mr-2"></i> Ubah Barang');

                            if ($('#cancelEdit').length === 0) {
                                $('<button type="button" id="cancelEdit" class="btn btn-secondary mb-3">Batal</button>')
                                    .insertAfter('#addJualDetail')
                                    .on('click', resetFormToAddMode);
                            }
                        });
                });

                // button untuk menghapus barang detail penjualan
                $(document).on('submit', '.delete-djual-form', function(e) {
                    e.preventDefault();

                    if (!confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
                        return;
                    }

                    const form = $(this);
                    const actionUrl = form.attr('action');

                    $.ajax({
                        url: actionUrl,
                        type: 'POST',
                        data: form.serialize(),
                        success: function(response) {
                            console.log('Delete Response:', response);
                            $('#Total_Bruto').val(response.data.Total_Bruto);
                            $('#Total_Diskon').val(response.data.Total_Diskon);
                            $('#Total_Jumlah').val(response.data.Total_Jumlah);
                            $('#Harga').val('');
                            $('#Qty').val('');
                            $('#Diskon').val('');
                            $('#Bruto').val('');
                            $('#Jumlah').val('');
                            resetFormToAddMode()
                            updateBarangDropdown(response.data.availableBarangs);
                            showToast(response.message, 'success');
                            $('#jualDetailTable').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            showToast('Gagal menghapus data', 'error');
                            console.error(xhr.responseText);
                        }
                    });
                });

                // form

                $('#jualDetailForm').submit(function(e) {
                    e.preventDefault();

                    console.log("Form is being submitted");

                    const formData = $(this).serializeArray();
                    formData.push({
                        name: 'No_Faktur',
                        value: '{{ $jual->No_Faktur }}'
                    });

                    // Hilangkan koma di Harga, Bruto, dan Jumlah
                    formData.forEach(item => {
                        if (['Harga', 'Bruto', 'Jumlah'].includes(item.name)) {
                            item.value = item.value.replace(/,/g, '');
                        }
                    });

                    const url = editMode ? editUrl : "{{ route('djuals.store') }}";
                    const method = editMode ? 'PUT' : 'POST';

                    $.ajax({
                        url: url,
                        type: method,
                        data: formData,
                        success: function(response) {
                            console.log('jualDetailForm Response:', response);
                            $('#Total_Bruto').val(response.data.Total_Bruto);
                            $('#Total_Diskon').val(response.data.Total_Diskon);
                            $('#Total_Jumlah').val(response.data.Total_Jumlah);
                            updateBarangDropdown(response.data.availableBarangs);
                            $('#jualDetailTable').DataTable().ajax.reload();
                            $('#jualDetailForm')[0].reset();
                            resetFormToAddMode();

                            showToast('Penjualan berhasil diupdate!', 'success');
                        },
                        error: function(error) {
                            const errors = error.responseJSON.errors;
                            for (const key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    $(`#error_${key}`).text(errors[key][0]);
                                }
                            }
                        }
                    });
                });

                function resetFormToAddMode() {
                    editMode = false;
                    editUrl = '';
                    $('#jualDetailForm')[0].reset();
                    $('#Kode_Barang').prop('disabled', false);
                    $('#Nama_Barang').prop('disabled', false);

                    loadAvailableBarangs();

                    $('#addJualDetail')
                        .removeClass('btn-warning')
                        .addClass('btn-info')
                        .html('<i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Barang');

                    $('#cancelEdit').remove();
                }

            });
        </script>
    @endpush
@endsection
