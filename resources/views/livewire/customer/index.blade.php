<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Daftar Customer</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <input type="text" wire:model.live="search" placeholder="Cari customer..."
            class="p-2 border rounded shadow-sm w-1/3">
        <a href="{{ route('customers.create') }}" wire:navigate
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Tambah Customer
        </a>
    </div>

    @if ($customers->isEmpty())
        <p>Tidak ada data customer yang ditemukan.</p>
    @else
        <table class="min-w-full bg-white border rounded shadow-md">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Kode Customer</th>
                    <th class="py-2 px-4 border-b">Nama Customer</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr wire:key="{{ $customer->Kode_Customer }}">
                        <td class="py-2 px-4 border-b text-center">{{ $customer->Kode_Customer }}</td>
                        <td class="py-2 px-4 border-b">{{ $customer->Nama_Customer }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <a href="{{ route('customers.edit', $customer->Kode_Customer) }}" wire:navigate
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-xs mr-2">
                                Edit
                            </a>
                            <button wire:click="delete('{{ $customer->Kode_Customer }}')"
                                wire:confirm="Anda yakin ingin menghapus customer ini?"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $customers->links() }}
        </div>
    @endif
</div>
