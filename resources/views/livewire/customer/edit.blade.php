<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Edit Customer</h2>

    <form wire:submit="update" class="bg-white p-6 rounded shadow-md">
        <div class="mb-4">
            <label for="kode_customer" class="block text-gray-700 text-sm font-bold mb-2">Kode Customer:</label>
            <input type="text" id="kode_customer" wire:model="kode_customer" readonly disabled
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight focus:outline-none focus:shadow-outline">
            {{-- Tidak perlu error untuk kode_customer karena readonly --}}
        </div>

        <div class="mb-4">
            <label for="nama_customer" class="block text-gray-700 text-sm font-bold mb-2">Nama Customer:</label>
            <input type="text" id="nama_customer" wire:model="nama_customer"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('nama_customer')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update
            </button>
            <a href="{{ route('customers.index') }}" wire:navigate
                class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Batal
            </a>
        </div>
    </form>
</div>
