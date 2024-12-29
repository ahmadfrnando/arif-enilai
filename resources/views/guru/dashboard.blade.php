@extends('guru.layouts.master')

@section('content')
<div class="p-4 mt-14">
    <div class="grid grid-cols-1 gap-4 mb-4">
        <div class="w-full py-6 bg-white border border-gray-200 rounded-lg shadow">
            <div class="flex flex-col items-center pb-10">
                @if(auth()->user()->foto)
                <img class="w-40 h-40 mb-3 rounded-full shadow-lg" src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Bonnie image" />
                @else
                <div class="w-40 h-40 rounded-full shadow-lg text-6xl bg-gray-200 rounded flex items-center justify-center text-center">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                @endif
                <h5 class="mb-1 text-lg font-medium text-gray-900">{{ $guru->nama_guru }}</h5>
                <span class="text-md text-gray-500">{{ $guru->nip }}</span>
                <span class="text-md text-gray-500">Mata Pelajaran <b>({{ $guru->mapel->nama_mapel_lengkap }})</b></span>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4 mb-4">
        <a href="{{ route('guru.siswa') }}" class="group flex justify-between p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Total Siswa Keseluruhan</h5>
                <p class="font-normal text-2xl text-gray-700">{{ $siswa }}</p>
            </div>
            <svg class="w-20 h-20 text-gray-800 group-hover:text-orange-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd" />
            </svg>
        </a>
        <a href="{{ route('guru.kelas') }}" class="group flex justify-between p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Total Kelas</h5>
                <p class="font-normal text-2xl text-gray-700">{{ $kelas }}</p>
            </div>
            <svg class="w-20 h-20 text-gray-800 group-hover:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                <path fill-rule="evenodd" d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
    <div class="grid grid-cols-4 gap-4">
        <a href="{{ route('guru.nilai-pengetahuan') }}" class="group flex justify-between p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Nilai pengetahuan yang <u>sudah</u> diberikan</h5>
                <p class="font-normal text-2xl text-gray-700">{{ $nilaiPengetahuan }}</p>
            </div>
            <svg class="w-20 h-20 text-gray-800 group-hover:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                <path fill-rule="evenodd" d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd" />
            </svg>
        </a>
        <a href="{{ route('guru.nilai-keterampilan') }}" class="group flex justify-between p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Nilai keterampilan yang <u>sudah</u> diberikan</h5>
                <p class="font-normal text-2xl text-gray-700">{{ $nilaiKeterampilan }}</p>
            </div>
            <svg class="w-20 h-20 text-gray-800 group-hover:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                <path fill-rule="evenodd" d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd" />
            </svg>
        </a>
        <a href="{{ route('guru.nilai-pengetahuan') }}" class="group flex justify-between p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Nilai pengetahuan yang <u>belum</u> diberikan</h5>
                <p class="font-normal text-2xl text-gray-700">{{ $belumNilaiPengetahuan }}</p>
            </div>
            <svg class="w-20 h-20 text-gray-800 group-hover:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                <path fill-rule="evenodd" d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd" />
            </svg>
        </a>
        <a href="{{ route('guru.nilai-keterampilan') }}" class="group flex justify-between p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Nilai keterampilan yang <u>belum</u> diberikan</h5>
                <p class="font-normal text-2xl text-gray-700">{{ $belumNilaiKeterampilan }}</p>
            </div>
            <svg class="w-20 h-20 text-gray-800 group-hover:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                <path fill-rule="evenodd" d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</div>
@endsection