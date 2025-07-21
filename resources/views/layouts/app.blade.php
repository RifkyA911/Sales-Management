<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aplikasi Customer</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- @livewireStyles --}}
</head>

<body class="font-sans antialiased leading-normal tracking-tight text-gray-900 bg-gray-50">
    <div class="flex flex-col min-h-screen">
        {{-- Navbar (opsional, contoh sederhana) --}}
        <nav class="p-4 bg-white border-b border-gray-200 shadow-sm">
            <div class="container flex items-center justify-between mx-auto">
                <div class="flex gap-4 items-center">
                    <i class="fa-solid fa-receipt fa-lg"></i>
                    <a href="{{ route('customers.index') }}"
                        class="text-xl font-bold text-gray-800 transition-colors duration-200 hover:text-blue-600 align-baseline">
                        Aplikasi Transaksi Penjualan
                    </a>
                </div>
                {{-- Navigasi tambahan di sini jika ada --}}
                <div>
                    <a href="{{ route('customers.index') }}"
                        class="mx-2 text-gray-600 transition-colors duration-200 hover:text-blue-600">Home</a>
                    {{-- <a href="#" class="mx-2 text-gray-600 transition-colors duration-200 hover:text-blue-600">About</a> --}}
                </div>
            </div>
        </nav>

        {{-- Konten Utama Halaman --}}
        <main class="container flex-grow px-4 py-8 mx-auto">
            @yield('content')
        </main>

        {{-- Footer (opsional) --}}
        <footer class="py-4 mt-8 text-center text-gray-600 bg-gray-100 border-t border-gray-200">
            &copy; {{ date('Y') }} Aplikasi Customer. Dibuat dengan Laravel & Tailwind CSS.
        </footer>
    </div>

    {{-- Jika Anda memutuskan kembali ke Livewire di masa depan --}}
    {{-- @livewireScripts --}}
    <div id="toast-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;"></div>

    @stack('scripts')
</body>

</html>
