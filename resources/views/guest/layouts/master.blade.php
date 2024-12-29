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

        .jumbotron {
            background-image: url('http://localhost:8000/bg-jumbotron.jpg');
        }
    </style>

</head>

<body class="flex flex-col min-h-screen">
    <nav class="bg-blue-900 border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('logo.svg') }}" class="h-8" alt="Logo Sekolah" />
                <span class="self-center text-2xl text-white font-semibold whitespace-nowrap">SMK Kartika Medan</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a href="/login" type="button" class="text-dark bg-blue-300 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Login</a>
                <button data-collapse-toggle="navbar-cta" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-cta" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                    <li>
                        <a href="#" class="block py-2 px-3 md:p-0 text-blue-300 bg-blue-700 rounded md:bg-transparent" aria-current="page">Beranda</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 md:p-0 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700">Tentang Kami</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 md:p-0 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700">Gallery</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 md:p-0 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700">Data Sekolah</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 md:p-0 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700">Hubungi Kami</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="flex-grow">
        <div class="">
            @yield('content') <!-- Konten Dinamis -->
        </div>
    </main>

    @include('sweetalert::alert')
    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>