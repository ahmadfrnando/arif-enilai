@extends('guru.layouts.master')

@section('content')
<div class="p-6 mt-14 space-y-4">
    <a href="{{ route('guru.siswa') }}" class="text-white bg-blue-700 mb-4 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
        </svg>
        <span class="sr-only">Kembali</span>
    </a>
    <div class="grid grid-cols-1 gap-4 mb-4">
        <div class="w-full flex p-4 gap-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div>
                @if ($siswa->pas_foto)
                <img src="{{ asset('storage/' . $siswa->pas_foto) }}" alt="foto siswa {{ $siswa->nama_siswa }}">
                @else
                <div class="w-60 h-64 bg-gray-200 rounded flex items-center justify-center">
                    <span class="text-6xl">{{ strtoupper(substr($siswa->nama_siswa, 0, 2)) }}</span>
                </div>
                @endif
            </div>
            <div class="flex flex-col gap-4">
                <h1 class="text-2xl font-bold">{{ $siswa->nama_siswa }}</h1>
                <h2 class="text-xl text-gray-500">{{ $siswa->nisn }}</h2>
                <h2 class="mb-2 text-lg text-gray-900">Hasil nilai <b>{{ $guru->mapel->nama_mapel_lengkap }}</b> selama satu semester di kelas <b>{{ $siswa->kelas->nama_kelas }}</b> pada <b>Semester {{ $siswa->semester_sekarang }}</b>:</h2>
                <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                    <li class="flex items-center">
                        <svg class="w-3.5 h-3.5 me-2 {!! $nilaiPengetahuan ? 'text-green-500' : 'text-gray-500' !!} flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        Nilai Pengetahuan: {!! $nilaiPengetahuan ? '<b>'.$nilaiPengetahuan->nilai_pengetahuan.'</b>' : '<a href="/guru/nilai-pengetahuan?cari='.$siswa->id.'"><span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded border border-red-400">Belum diberi nilai</span></a>'
                        !!}
                    </li>
                    <li class="flex items-center">
                        <svg class="w-3.5 h-3.5 me-2 {!! $nilaiKeterampilan ? 'text-green-500' : 'text-gray-500' !!} flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        Nilai Keterampilan: {!! $nilaiKeterampilan ? '<b>'.$nilaiKeterampilan->nilai_keterampilan.'</b>' : '<a href="/guru/nilai-keterampilan?cari='.$siswa->id.'"><span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded border border-red-400">Belum diberi nilai</span></a>' !!}
                    </li>
                </ul>
                @if(!$cekSiswaLulus)
                <div>
                    <button type="button" data-modal-target="modal-lulus" data-modal-toggle="modal-lulus" class="px-3 py-2 text-sm font-medium text-center inline-flex {!! $nilaiPengetahuan && $nilaiKeterampilan ? '' : 'cursor-not-allowed' !!}  items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" {!! $nilaiPengetahuan && $nilaiKeterampilan ? '' : 'disabled' !!}>
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                        </svg>
                        Lulus
                    </button>
                    <div id="modal-lulus" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-lulus">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin akan memberikan kelulusan kepada siswa <b>{{ $siswa->nama_siswa }}</b> dengan nilai pengetahuan <b>{!! $nilaiPengetahuan->nilai_pengetahuan ?? '-' !!}</b> dan nilai keterampilan <b>{!! $nilaiKeterampilan->nilai_keterampilan ?? '-' !!}</b> di kelas <b>{{ $siswa->kelas->nama_kelas }}</b> pada <b>semester {{ $siswa->semester_sekarang }}</b> ?</h3>
                                    <form action="{{ route('guru.siswa.lulus') }}" method="POST" class="flex mx-auto justify-center gap-2">
                                        @csrf
                                        <input value="{{ $siswa->id }}" type="number" name="id_siswa" hidden>
                                        <input value="{{ $siswa->id_kelas_sekarang }}" type="number" name="id_kelas_sekarang" hidden>
                                        <input value="{{ $guru->mapel->id }}" type="number" name="id_mapel" hidden>
                                        <input value="{{ $siswa->semester_sekarang }}" type="number" name="semester" hidden>
                                        <input value="{{ Auth::user()->id_guru }}" type="number" name="id_guru" hidden>
                                        <input value="1" type="number" name="id_status" hidden>
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Ya, saya yakin
                                        </button>
                                        <button data-modal-hide="modal-lulus" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" data-modal-target="modal-tidak-lulus" data-modal-toggle="modal-tidak-lulus" class="px-3 py-2 text-sm font-medium text-center inline-flex {!! $nilaiPengetahuan && $nilaiKeterampilan ? '' : 'cursor-not-allowed' !!} items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300" {!! $nilaiPengetahuan && $nilaiKeterampilan ? '' : 'disabled' !!}>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Tidak Lulus
                    </button>
                    <div id="modal-tidak-lulus" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow">
                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="modal-tidak-lulus">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin akan tidak meluluskan siswa {{ $siswa->nama_siswa }} ?</h3>
                                    <button type="button" data-modal-target="modal-beri-alasan" data-modal-toggle="modal-beri-alasan" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Ya, beri alasan
                                    </button>
                                    <div id="modal-beri-alasan" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow">
                                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="modal-beri-alasan">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-4 md:p-5 text-center">
                                                    <form action="{{ route('guru.siswa.lulus') }}" method="post">
                                                        @csrf
                                                        <input value="{{ $siswa->id }}" type="number" name="id_siswa" hidden>
                                                        <input value="{{ $guru->mapel->id }}" type="number" name="id_mapel" hidden>
                                                        <input value="{{ $siswa->semester_sekarang }}" type="number" name="semester" hidden>
                                                        <input value="{{ Auth::user()->id_guru }}" type="number" name="id_guru" hidden>
                                                        <input value="2" type="number" name="id_status" hidden>
                                                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alasan:</label>
                                                        <textarea id="message" name="alasan" rows="4" class="block mb-4 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Submit
                                                        </button>
                                                        <button data-modal-hide="modal-beri-alasan" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batal</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button data-modal-hide="modal-tidak-lulus" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="flex items-center p-4 mb-4 text-sm {!! $cekSiswaLulus->id_status == 1 ? 'text-green-800 bg-green-50 border-green-300' : 'text-red-800 bg-red-50 border-red-300' !!} border rounded-lg" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        Siswa sudah dinyatakan
                        {!! $cekSiswaLulus->id_status == 1 ? '<b>lulus</b>' : '<b>tidak lulus</b>' !!}
                        oleh <b>{{ $cekSiswaLulus->guru->nama_guru }}</b>
                        {!! $cekSiswaLulus->id_status == 2 ? ' dengan alasan ' . $cekSiswaLulus->alasan : '' !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection