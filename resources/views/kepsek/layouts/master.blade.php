<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
    @stack('styles') <!-- Untuk CSS tambahan -->
    <style>
        table {
            text-transform: uppercase !important;
        }
    </style>

</head>

<body class="flex flex-col min-h-screen">
    @include('kepsek.partials.navbar') <!-- Navbar -->
    @include('kepsek.partials.sidebar') <!-- Sidebar -->

    <main class="flex-grow">
        <div class="p-4 sm:ml-64">
            @yield('content') <!-- Konten Dinamis -->
        </div>
    </main>

    @include('kepsek.partials.footer') <!-- Footer -->

    @include('sweetalert::alert')
    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>