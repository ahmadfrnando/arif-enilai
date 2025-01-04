@extends('siswa.layouts.master')

@section('content')

<div class="p-4 mt-14">
    <div class="mb-4 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="kelas-1" data-tabs-target="#kelas1" type="button" role="tab" aria-controls="kelas-1" aria-selected="true">Kelas 1</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="kelas-2" data-tabs-target="#kelas2" type="button" role="tab" aria-controls="kelas-2" aria-selected="false">Kelas 2</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="kelas-3" data-tabs-target="#kelas3" type="button" role="tab" aria-controls="kelas-3" aria-selected="false">Kelas 3</button>
            </li>
        </ul>
    </div>

    <div id="default-tab-content">
        <div class="px-4 w-auto">
            <a href="{{ route('siswa.download') }}" class="focus:outline-none flex justify-center gap-1 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"><svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" />
                </svg>
                Unduh Laporan Nilai Akademik</a>
        </div>
        <!-- Tab Kelas 1 -->
        <div class="hidden p-4 rounded-lg" id="kelas1" role="tabpanel" aria-labelledby="kelas-1">
            @if($data['kelas1']->isNotEmpty())
            <div class="w-full mb-4 p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8">
                <h5 class="mb-2 text-3xl font-bold text-gray-900">Laporan Nilai {{ $data['reportSiswa']->nama_siswa }}</h5>
                <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
                    <div class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                        <div class="text-left rtl:text-right">
                            <div>{{ $data['reportSiswa']->nama_kelas }}</div>
                        </div>
                    </div>
                    <div class="w-full sm:w-auto {!! $data['reportSiswa']->status == 'Lulus' ? 'bg-green-500 hover:bg-green-700 focus:ring-green-300' : 'bg-red-500 hover:bg-red-700 focus:ring-red-300' !!} focus:ring-4 focus:outline-none  text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                        <div class="text-left rtl:text-right">
                            <div class="flex items-center justify-center space-x-2">
                                @if($data['reportSiswa']->status == 'Lulus')
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11 9a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                                    <path fill-rule="evenodd" d="M9.896 3.051a2.681 2.681 0 0 1 4.208 0c.147.186.38.282.615.255a2.681 2.681 0 0 1 2.976 2.975.681.681 0 0 0 .254.615 2.681 2.681 0 0 1 0 4.208.682.682 0 0 0-.254.615 2.681 2.681 0 0 1-2.976 2.976.681.681 0 0 0-.615.254 2.682 2.682 0 0 1-4.208 0 .681.681 0 0 0-.614-.255 2.681 2.681 0 0 1-2.976-2.975.681.681 0 0 0-.255-.615 2.681 2.681 0 0 1 0-4.208.681.681 0 0 0 .255-.615 2.681 2.681 0 0 1 2.976-2.975.681.681 0 0 0 .614-.255ZM12 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" clip-rule="evenodd" />
                                    <path d="M5.395 15.055 4.07 19a1 1 0 0 0 1.264 1.267l1.95-.65 1.144 1.707A1 1 0 0 0 10.2 21.1l1.12-3.18a4.641 4.641 0 0 1-2.515-1.208 4.667 4.667 0 0 1-3.411-1.656Zm7.269 2.867 1.12 3.177a1 1 0 0 0 1.773.224l1.144-1.707 1.95.65A1 1 0 0 0 19.915 19l-1.32-3.93a4.667 4.667 0 0 1-3.4 1.642 4.643 4.643 0 0 1-2.53 1.21Z" />
                                </svg>
                                @endif
                                <span class="text-center">{{ $data['reportSiswa']->status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <figure class="max-w-screen-md mx-auto mt-4 text-center">
                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                        <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z" />
                    </svg>
                    <blockquote>
                        <p class="text-2xl italic font-medium text-gray-900 dark:text-white">"{{ $data['reportSiswa']->pesan }}"</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3 rtl:space-x-reverse">
                        <div class="flex items-center divide-x-2 rtl:divide-x-reverse divide-gray-500 dark:divide-gray-700">
                            <cite class="pe-3 font-medium text-gray-900 dark:text-white">{{ $data['reportSiswa']->nama_guru }}</cite>
                            <cite class="ps-3 text-sm text-gray-500 dark:text-gray-400">Wali Kelas</cite>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Mata Pelajaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                KKM
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nilai Pengetahuan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Predikat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nilai Keterampilan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Predikat
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(is_array($data['reportSiswa']->nilai))
                        @foreach($data['reportSiswa']->nilai as $nilaiGroup)
                        @foreach($nilaiGroup as $r)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $r['nama_mapel'] }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $r['kkm'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $r['pengetahuan']['nilai'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $r['pengetahuan']['predikat'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $r['keterampilan']['nilai'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $r['keterampilan']['predikat'] }}
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center">
                                Data nilai tidak ditemukan atau format tidak valid.
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @else
            <p>Belum ada data untuk Kelas 1.</p>
            @endif
        </div>

        <!-- Tab Kelas 2 -->
        <div class="hidden p-4 rounded-lg" id="kelas2" role="tabpanel" aria-labelledby="kelas-2">
            @if($data['kelas2']->isNotEmpty())
            <div class="w-full mb-4 p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8">
                <h5 class="mb-2 text-3xl font-bold text-gray-900">Laporan Nilai {{ $data['reportSiswa']->nama_siswa }}</h5>
                <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
                    <div class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                        <div class="text-left rtl:text-right">
                            <div>{{ $data['reportSiswa']->nama_kelas }}</div>
                        </div>
                    </div>
                    <div class="w-full sm:w-auto {!! $data['reportSiswa']->status == 'Lulus' ? 'bg-green-500 hover:bg-green-700 focus:ring-green-300' : 'bg-red-500 hover:bg-red-700 focus:ring-red-300' !!} focus:ring-4 focus:outline-none  text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                        <div class="text-left rtl:text-right">
                            <div class="flex items-center justify-center space-x-2">
                                @if($data['reportSiswa']->status == 'Lulus')
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11 9a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                                    <path fill-rule="evenodd" d="M9.896 3.051a2.681 2.681 0 0 1 4.208 0c.147.186.38.282.615.255a2.681 2.681 0 0 1 2.976 2.975.681.681 0 0 0 .254.615 2.681 2.681 0 0 1 0 4.208.682.682 0 0 0-.254.615 2.681 2.681 0 0 1-2.976 2.976.681.681 0 0 0-.615.254 2.682 2.682 0 0 1-4.208 0 .681.681 0 0 0-.614-.255 2.681 2.681 0 0 1-2.976-2.975.681.681 0 0 0-.255-.615 2.681 2.681 0 0 1 0-4.208.681.681 0 0 0 .255-.615 2.681 2.681 0 0 1 2.976-2.975.681.681 0 0 0 .614-.255ZM12 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" clip-rule="evenodd" />
                                    <path d="M5.395 15.055 4.07 19a1 1 0 0 0 1.264 1.267l1.95-.65 1.144 1.707A1 1 0 0 0 10.2 21.1l1.12-3.18a4.641 4.641 0 0 1-2.515-1.208 4.667 4.667 0 0 1-3.411-1.656Zm7.269 2.867 1.12 3.177a1 1 0 0 0 1.773.224l1.144-1.707 1.95.65A1 1 0 0 0 19.915 19l-1.32-3.93a4.667 4.667 0 0 1-3.4 1.642 4.643 4.643 0 0 1-2.53 1.21Z" />
                                </svg>
                                @endif
                                <span class="text-center">{{ $data['reportSiswa']->status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <figure class="max-w-screen-md mx-auto mt-4 text-center">
                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                        <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z" />
                    </svg>
                    <blockquote>
                        <p class="text-2xl italic font-medium text-gray-900 dark:text-white">"{{ $data['reportSiswa']->pesan }}"</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3 rtl:space-x-reverse">
                        <div class="flex items-center divide-x-2 rtl:divide-x-reverse divide-gray-500 dark:divide-gray-700">
                            <cite class="pe-3 font-medium text-gray-900 dark:text-white">{{ $data['reportSiswa']->nama_guru }}</cite>
                            <cite class="ps-3 text-sm text-gray-500 dark:text-gray-400">Wali Kelas</cite>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Mata Pelajaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                KKM
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nilai Pengetahuan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Predikat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nilai Keterampilan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Predikat
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(is_array($data['reportSiswa']->nilai))
                        @foreach($data['reportSiswa']->nilai as $nilaiGroup)
                        @foreach($nilaiGroup as $r)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $r['nama_mapel'] }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $r['kkm'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $r['pengetahuan']['nilai'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $r['pengetahuan']['predikat'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $r['keterampilan']['nilai'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $r['keterampilan']['predikat'] }}
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center">
                                Data nilai tidak ditemukan atau format tidak valid.
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            @else
            <p>Belum ada data untuk Kelas 2.</p>
            @endif
        </div>

        <!-- Tab Kelas 3 -->
        <div class="hidden p-4 rounded-lg" id="kelas3" role="tabpanel" aria-labelledby="kelas-3">
            @if($data['kelas3']->isNotEmpty())
            <div class="w-full mb-4 p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8">
                <h5 class="mb-2 text-3xl font-bold text-gray-900">Laporan Nilai {{ $data['reportSiswa']->nama_siswa }}</h5>
                <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
                    <div class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                        <div class="text-left rtl:text-right">
                            <div>{{ $data['reportSiswa']->nama_kelas }}</div>
                        </div>
                    </div>
                    <div class="w-full sm:w-auto {!! $data['reportSiswa']->status == 'Lulus' ? 'bg-green-500 hover:bg-green-700 focus:ring-green-300' : 'bg-red-500 hover:bg-red-700 focus:ring-red-300' !!} focus:ring-4 focus:outline-none  text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                        <div class="text-left rtl:text-right">
                            <div class="flex items-center justify-center space-x-2">
                                @if($data['reportSiswa']->status == 'Lulus')
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11 9a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                                    <path fill-rule="evenodd" d="M9.896 3.051a2.681 2.681 0 0 1 4.208 0c.147.186.38.282.615.255a2.681 2.681 0 0 1 2.976 2.975.681.681 0 0 0 .254.615 2.681 2.681 0 0 1 0 4.208.682.682 0 0 0-.254.615 2.681 2.681 0 0 1-2.976 2.976.681.681 0 0 0-.615.254 2.682 2.682 0 0 1-4.208 0 .681.681 0 0 0-.614-.255 2.681 2.681 0 0 1-2.976-2.975.681.681 0 0 0-.255-.615 2.681 2.681 0 0 1 0-4.208.681.681 0 0 0 .255-.615 2.681 2.681 0 0 1 2.976-2.975.681.681 0 0 0 .614-.255ZM12 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" clip-rule="evenodd" />
                                    <path d="M5.395 15.055 4.07 19a1 1 0 0 0 1.264 1.267l1.95-.65 1.144 1.707A1 1 0 0 0 10.2 21.1l1.12-3.18a4.641 4.641 0 0 1-2.515-1.208 4.667 4.667 0 0 1-3.411-1.656Zm7.269 2.867 1.12 3.177a1 1 0 0 0 1.773.224l1.144-1.707 1.95.65A1 1 0 0 0 19.915 19l-1.32-3.93a4.667 4.667 0 0 1-3.4 1.642 4.643 4.643 0 0 1-2.53 1.21Z" />
                                </svg>
                                @endif
                                <span class="text-center">{{ $data['reportSiswa']->status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <figure class="max-w-screen-md mx-auto mt-4 text-center">
                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                        <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z" />
                    </svg>
                    <blockquote>
                        <p class="text-2xl italic font-medium text-gray-900 dark:text-white">"{{ $data['reportSiswa']->pesan }}"</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3 rtl:space-x-reverse">
                        <div class="flex items-center divide-x-2 rtl:divide-x-reverse divide-gray-500 dark:divide-gray-700">
                            <cite class="pe-3 font-medium text-gray-900 dark:text-white">{{ $data['reportSiswa']->nama_guru }}</cite>
                            <cite class="ps-3 text-sm text-gray-500 dark:text-gray-400">Wali Kelas</cite>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Mata Pelajaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                KKM
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nilai Pengetahuan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Predikat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nilai Keterampilan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Predikat
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(is_array($data['reportSiswa']->nilai))
                        @foreach($data['reportSiswa']->nilai as $nilaiGroup)
                        @foreach($nilaiGroup as $r)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $r['nama_mapel'] }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $r['kkm'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $r['pengetahuan']['nilai'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $r['pengetahuan']['predikat'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $r['keterampilan']['nilai'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $r['keterampilan']['predikat'] }}
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center">
                                Data nilai tidak ditemukan atau format tidak valid.
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            @else
            <p>Belum ada data untuk Kelas 3.</p>
            @endif
        </div>
    </div>
</div>


@endsection