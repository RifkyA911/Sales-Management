@csrf
<div class="space-y-4">
    <div class="form-control">
        <label class="label">Kode Barang</label>
        <input type="text" name="Kode_Barang" class="input input-bordered"
            value="{{ old('Kode_Barang', $barang->Kode_Barang ?? '') }}" maxlength="10" required>
        @error('Kode_Barang')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-control">
        <label class="label">Nama Barang</label>
        <input type="text" name="Nama_Barang" class="input input-bordered"
            value="{{ old('Nama_Barang', $barang->Nama_Barang ?? '') }}" maxlength="20" required>
        @error('Nama_Barang')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-control">
        <label class="label">Harga Barang</label>
        <input type="number" step="0.01" name="Harga_Barang" class="input input-bordered"
            value="{{ old('Harga_Barang', $barang->Harga_Barang ?? '') }}" required>
        @error('Harga_Barang')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>
</div>
