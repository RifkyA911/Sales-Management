<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @fluxAppearance --}}
</head>

<body class="text-gray-800 bg-gray-100 dark:bg-gray-800 dark:text-gray-200">
    {{ $slot }}
    {{-- @fluxScripts --}}
</body>
<script>
    function showToastify(message, type = "info") {
        let bgColor = "#3498db"; // default biru
        if (type === "success") bgColor = "#28a745";
        if (type === "error") bgColor = "#e74c3c";
        if (type === "warning") bgColor = "#f39c12";

        Toastify({
            text: message,
            duration: 3000,
            gravity: "top", // "top" atau "bottom"
            position: "right", // "left", "center" atau "right"
            backgroundColor: bgColor,
            stopOnFocus: true,
            close: true
        }).showToast();
    }
</script>

</html>
