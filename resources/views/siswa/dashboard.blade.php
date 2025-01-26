@extends('siswa.layouts.master')

@section('content')
<div class="p-4 mt-14">
    <div class="grid grid-cols-1 gap-4 mb-4">
        <div class="w-full py-6 bg-white border border-gray-200 rounded-lg shadow">
            <div class="flex flex-col items-center pb-10">
                @if(Auth::user()->foto)
                <img class="w-40 h-40 mb-3 rounded-full shadow-lg" src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Bonnie image" />
                @else
                <div class="w-40 h-40 mb3 rounded-full text-6xl shadow-lg bg-gray-200 flex items-center justify-center text-center">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                @endif
                <h5 class="mb-1 text-lg font-medium text-gray-900">{{ $siswa->nama_siswa }}</h5>
                <span class="text-md text-gray-500">{{ $siswa->nisn }}</span>
                <span class="text-md text-gray-500">{{ $siswa->kelas->nama_kelas }} (Semester {{ $siswa->semester_sekarang }})</span>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-4 gap-4 mb-4">
        <a class="group flex justify-between p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Nilai Pengetahuan Tertinggi</h5>
                <p class="font-semibold text-2xl text-gray-700">{{ $nilaiPengetahuanTertinggi }}</p>
            </div>
            <svg class="w-20 h-20 text-gray-800 group-hover:text-orange-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd" />
            </svg>
        </a>
        <a class="group flex justify-between p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Nilai Pengetahuan Terendah</h5>
                <p class="font-semibold text-2xl text-gray-700">{{ $nilaiPengetahuanTerendah }}</p>
            </div>
            <svg class="w-20 h-20 text-gray-800 group-hover:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                <path fill-rule="evenodd" d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd" />
            </svg>
        </a>
        <a class="group flex justify-between p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Nilai Keterampilan Tertinggi</h5>
                <p class="font-semibold text-2xl text-gray-700">{{ $nilaiKeterampilanTertinggi }}</p>
            </div>
            <svg class="w-20 h-20 text-gray-800 group-hover:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd" />
            </svg>
        </a>
        <a class="group flex justify-between p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Nilai Keterampilan Terendah</h5>
                <p class="font-semibold text-2xl text-gray-700">{{ $nilaiKeterampilanTerendah }}</p>
            </div>
            <svg class="w-20 h-20 text-gray-800 group-hover:text-purple-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                <path fill-rule="evenodd" d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div class="relative border border-gray-200 h-[480px] rounded-lg shadow overflow-x-auto sm:rounded-lg">
            <h1 class="px-6 py-3 text-2xl font-bold tracking-tight text-gray-900">Nilai Semester Saat Ini</h1>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 border-b uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th class="px-6 py-3">
                            Mata pelajaran
                        </th>
                        <th class="px-6 py-3">
                            KKM
                        </th>
                        <th class="px-6 py-3">
                            Nilai Pengetahuan
                        </th>
                        <th class="px-6 py-3">
                            Nilai Keterampilan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nilaiSiswa as $key => $m)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4">
                            {{ $nilaiSiswa->firstItem() + $key }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $m->mapel->nama_mapel_lengkap }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $m->mapel->kkm }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $m->nilai_pengetahuan ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $m->nilai_keterampilan ?? '-' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $nilaiSiswa->links() }}
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50">
        <p class="text-2xl text-gray-400">
            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
            </svg>
        </p>
    </div>
</div>
@endsection