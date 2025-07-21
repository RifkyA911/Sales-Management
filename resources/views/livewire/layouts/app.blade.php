<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Penjualan</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles {{-- Ini penting untuk Livewire 3 --}}

    {{-- ******************************************* --}}
    {{-- TAMBAHKAN DIRECTIVE FLUX UI DI SINI --}}
    @fluxAppearance
    {{-- ******************************************* --}}

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        {{-- Konten utama Livewire akan dirender di sini melalui $slot --}}
        {{ $slot }}
    </div>

    @livewireScripts {{-- Ini penting untuk Livewire 3 --}}

    {{-- ******************************************* --}}
    {{-- TAMBAHKAN DIRECTIVE FLUX UI DI SINI --}}
    @fluxScripts
    {{-- ******************************************* --}}

</body>

</html>
