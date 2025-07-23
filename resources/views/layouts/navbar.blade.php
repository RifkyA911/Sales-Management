        <nav class="p-4 bg-white border-b border-gray-200 shadow-sm">
            <div class="container flex items-center justify-between mx-auto">
                <div class="flex gap-4 items-center">
                    <i class="fa-solid fa-receipt fa-lg"></i>
                    <a href="{{ route('juals.index') }}"
                        class="text-xl font-bold text-gray-800 transition-colors duration-200 hover:text-blue-600 align-baseline">
                        Aplikasi Transaksi Penjualan
                    </a>
                </div>
                {{-- Navigasi tambahan di sini jika ada --}}
                <div>
                    <a href="{{ route('customers.index') }}"
                        class="mx-2 text-gray-600 transition-colors duration-200 hover:text-blue-600">Customer</a>
                    <a href="{{ route('barangs.index') }}"
                        class="mx-2 text-gray-600 transition-colors duration-200 hover:text-blue-600">Product</a>
                </div>
            </div>
        </nav>
