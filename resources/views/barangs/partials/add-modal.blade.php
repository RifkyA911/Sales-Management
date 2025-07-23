<dialog id="addBarangModal" class="modal">
    <div class="modal-box p-4 bg-white rounded-lg shadow-lg sm:p-6 relative">
        <form method="dialog">
            <button class="absolute top-2 right-2 btn btn-sm btn-circle btn-ghost">✕</button>
        </form>
        <h3 class="text-lg font-bold mb-4">Tambah Barang</h3>

        @if ($errors->any())
            <div class="mb-4 text-sm text-red-700 bg-red-100 p-2 rounded">
                <strong>Oops!</strong> Ada beberapa masalah dengan input Anda.
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('barangs.store') }}" class="space-y-4">
            @csrf
            <fieldset class="fieldset ">
                <legend class="fieldset-legend">Kode Barang</legend>
                <div class="relative">
                    <input type="text" name="Kode_Barang" id="Kode_Barang" class="input w-full"
                        value="{{ \Illuminate\Support\Str::substr(time(), -10) }}" required maxlength="10" readonly>
                </div>
                <p class="mt-1 text-sm text-red-500" id="error_Kode_Barang"></p>
            </fieldset>
            <fieldset class="fieldset ">
                <legend class="fieldset-legend">Nama Barang</legend>
                <div class="relative">
                    <input type="text" name="Nama_Barang" class="input w-full" required maxlength="20">
                </div>
                <p class="mt-1 text-sm text-red-500" id="error_Nama_Barang"></p>
            </fieldset>
            <fieldset class="fieldset ">
                <legend class="fieldset-legend">Harga Barang</legend>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3  z-1">
                        <span class="font-medium">Rp.</span>
                    </div>
                    <input type="number" name="Harga_Barang" class="input pl-10 w-full" required step="0.01">
                </div>
                <p class="mt-1 text-sm text-red-500" id="error_Harga_Barang"></p>
            </fieldset>
            <div class="modal-action">
                <button type="button" onclick="addBarangModal.close()" class="btn">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</dialog>
