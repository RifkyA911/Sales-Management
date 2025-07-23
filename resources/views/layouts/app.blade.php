<!DOCTYPE html>
<html lang="en" data-theme="cupcake">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aplikasi Transaksi Penjualan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- @livewireStyles --}}
</head>

<body class="font-sans antialiased leading-normal tracking-tight text-gray-900 bg-gray-50">
    <div class="flex flex-col min-h-screen">
        {{-- Navbar (opsional, contoh sederhana) --}}
        @include('layouts.navbar')

        {{-- Konten Utama Halaman --}}
        <main class="container flex-grow p-4 mx-auto">
            @if (isset($breadcrumbs) && is_array($breadcrumbs))
                <div class="breadcrumbs text-sm p-4">
                    <ul>
                        @foreach ($breadcrumbs as $breadcrumb)
                            <li>
                                @if (isset($breadcrumb['url']))
                                    <a href="{{ $breadcrumb['url'] }}"
                                        class="{{ $breadcrumb['active'] ? 'font-bold text-blue-600' : '' }}">
                                        @if (!empty($breadcrumb['icon']))
                                            <i class="fa-solid {{ $breadcrumb['icon'] }}"></i>
                                        @endif
                                        {{ $breadcrumb['label'] }}
                                    </a>
                                @else
                                    <span
                                        class="inline-flex items-center gap-2 {{ $breadcrumb['active'] ? 'font-bold text-blue-600' : '' }}">
                                        @if (!empty($breadcrumb['icon']))
                                            <i class="fa-solid {{ $breadcrumb['icon'] }}"></i>
                                        @endif
                                        {{ $breadcrumb['label'] }}
                                    </span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>

        {{-- Footer (opsional) --}}
        <footer class="py-4 mt-8 text-center text-gray-600 bg-gray-100 border-t border-gray-200">
            &copy; {{ date('Y') }} Aplikasi Transaksi Penjualan.
        </footer>
    </div>

    {{-- @livewireScripts --}}
    <div id="toast-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;"></div>

    @stack('scripts')
</body>

</html>
