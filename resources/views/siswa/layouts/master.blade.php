<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="flex flex-col min-h-screen">
    @include('siswa.partials.navbar') <!-- Navbar -->
    @include('siswa.partials.sidebar') <!-- Sidebar -->

    <main class="flex-grow" id="main-content">
        <div class="p-4 sm:ml-64">
            @yield('content') <!-- Konten Dinamis -->
        </div>
    </main>

    @include('siswa.partials.footer') <!-- Footer -->
    @vite('resources/js/app.js')
    @include('sweetalert::alert')
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alertElement = document.querySelector('[data-sweet-alert]');
            if (alertElement) {
                const alertData = JSON.parse(alertElement.dataset.sweetAlert);
                Swal.fire(alertData);
            }
        });
    </script>
</body>

</html>