{{-- @extends('layouts.app')

@section('content') --}}
<dialog id="jualModal" class="modal ">
    <div id='jualContent' class="modal-box p-4 bg-white rounded-lg shadow-lg sm:p-6 relative">
        <div class="flex justify-between items-start mb-4">
            <button class="absolute top-4 right-4 btn btn-sm btn-circle btn-ghost "><i
                    class="fa-solid fa-xmark text-xl "></i></button>
            <div class="flex items-center gap-4">
                <i class="fa-solid fa-money-bill-wave text-xl"></i>
                <h3 class="font-bold text-lg" id="modalTitle">Tambah Penjualan</h3>
            </div>
        </div>

        <div id="jualAlert"></div>

        <form id="jualForm" class=" mt-4">
            @csrf
            <fieldset class="fieldset">
                <legend class="fieldset-legend" for="No_Faktur">No. Faktur</legend>
                <input type="text" name="No_Faktur" id="No_Faktur" class="w-full input" placeholder="Type here"
                    required maxlength="20">
                <p class="mt-1 text-sm text-red-500" id="error_No_Faktur"></p>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Kode Customer</legend>
                <select class="select w-full" id="customersSelect" name="Kode_Customer" required>
                    <option value="" disabled selected>Pilih Customer</option>
                </select>
                <p class="mt-1 text-sm text-red-500" id="error_Kode_Customer"></p>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Tanggal Faktur</legend>
                <input type="date" class="input w-full" name="Tgl_Faktur" required value="{{ date('Y-m-d') }}" />
                <p class="mt-1 text-sm text-red-500" id="error_Tgl_Faktur"></p>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Jenis Transaksi</legend>
                <select class="select w-full" id="jensSelect" name="Kode_Tjen" required>
                    <option value="" disabled selected>Pilih Jenis Transaksi</option>
                </select>
                <p class="mt-1 text-sm text-red-500" id="error_Kode_Tjen"></p>
            </fieldset>
            <input type="hidden" name="Total_Bruto" value="0">
            <input type="hidden" name="Total_Diskon" value="0">
            <input type="hidden" name="Total_Jumlah" value="0">

            <div class="modal-action">
                <button type="button" class="btn jualAlertMessageClose">Batal</button>
                <button type="submit" class="btn btn-info text-white">Simpan</button>
            </div>
        </form>
    </div>
</dialog>
{{-- @endsection --}}

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#jualForm').submit(function(e) {
                e.preventDefault();

                let noFaktur = $('#No_Faktur').val();
                // console.log("No Faktur:", noFaktur);

                $.ajax({
                    url: '{{ route('juals.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#jualContent').html(`
                            <div class="flex flex-col items-center justify-center p-6 jualAlertMessageClose">
                                <div class="flex flex-col justify-start text-center h-36">
                                    <i class="fa-solid fa-circle-check text-green-500 text-6xl mb-4"></i>
                                    <p class="text-lg font-semibold">Data <span class="id_invoice"></span> berhasil disimpan!</p>
                                </div>
                            </div>
                            <div class="flex justify-center gap-4 mt-4">
                                    <button class="btn jualAlertMessageClose">Tutup</button>
                                    <button id="tambahBarangBtn" class="btn btn-success text-white">
                                        Tambah
                                        Data Barang <i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        `);

                        $('.id_invoice').text(noFaktur);
                        $('#tambahBarangBtn').on('click', function() {
                            // window.location.href = '{{ route('juals.index') }}/' +
                            //     noFaktur + '/edit';
                            window.location.href = '/juals/' + encodeURIComponent(
                                noFaktur) + '/edit';
                        });

                        // setTimeout(() => {
                        //     window.location.href = '/juals/create';
                        // }, 1500);
                    },
                    error: function(error) {
                        console.log('Error:', error.responseText);

                        $('#jualForm p.text-red-500').text('');

                        if (error.responseJSON && error.responseJSON.errors) {
                            let errors = error.responseJSON.errors;
                            Object.keys(errors).forEach(function(key) {
                                $('#error_' + key).text(errors[key][0]);
                            });
                        } else {
                            alert('Terjadi kesalahan.');
                        }

                    }

                });

            });

        });
    </script>
@endpush
