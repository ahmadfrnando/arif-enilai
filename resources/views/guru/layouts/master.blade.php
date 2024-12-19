<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    @stack('styles') <!-- Untuk CSS tambahan -->
</head>

<body>
    @include('guru.partials.navbar') <!-- Navbar -->
    @include('guru.partials.sidebar') <!-- Sidebar -->

    <main>
        <div class="p-4 sm:ml-64">
            @yield('content') <!-- Konten Dinamis -->
        </div>
    </main>

    @include('guru.partials.footer') <!-- Footer -->

    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>