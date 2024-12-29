@extends('kepsek.layouts.master')

@section('content')
<div class="p-6 mt-14 space-y-4">
    <a href="{{ route('kepsek.dashboard') }}" class="text-white mb-4 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
        <svg class="w-5 h-5 mr-2 -ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
        </svg>
        Kembali ke dashboard
    </a>
    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Ganti Password</h1>
    <form action="{{ route('kepsek.ganti-password.update') }}" method="POST">
        @csrf
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mb-5">
                <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">Konformasi Password</label>
                <input type="password" id="confirm-password" name="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
        </div>
        <div class="flex mb-4">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Simpan</button>
        </div>
    </form>
</div>
@endsection