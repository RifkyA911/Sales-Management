<dialog id="addBarangModal" class="modal">
    <div class="p-4 bg-white rounded-lg shadow-lg sm:p-6 relative">
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
            <div class="form-control">
                <label class="label" for="Kode_Barang">Kode Barang</label>
                <input type="text" name="Kode_Barang" id="Kode_Barang" class="input bg-white" required
                    maxlength="10">
            </div>
            <div class="form-control">
                <label class="label" for="Nama_Barang">Nama Barang</label>
                <input type="text" name="Nama_Barang" class="input bg-white" required maxlength="20">
            </div>
            <div class="form-control">
                <label class="label" for="Harga_Barang">Harga Barang</label>
                <input type="number" name="Harga_Barang" class="input bg-white" required step="0.01">
            </div>
            <div class="modal-action">
                <button type="button" onclick="addBarangModal.close()" class="btn">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</dialog>
