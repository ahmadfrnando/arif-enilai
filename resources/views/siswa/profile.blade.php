@extends('siswa.layouts.master')

@section('content')
<div class="p-4 mt-14">
    <div class="grid grid-cols-1 gap-4 mb-4">
        <div class="w-full py-6 bg-white border border-gray-200 rounded-lg shadow">
            <div class="flex flex-col items-center pb-10">
                @if($siswa->pas_foto)
                <img class="w-70 h-70 mb-3 shadow-lg" src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Bonnie image" />
                @else
                <div class="w-72 h-72 mb-3 text-6xl shadow-lg bg-gray-200 flex items-center justify-center text-center">{{ strtoupper(substr($siswa->nama_siswa, 0, 2)) }}</div>
                @endif
                <h5 class="mb-1 text-lg font-medium text-gray-900">{{ $siswa->nama_siswa }}</h5>
                <span class="text-md text-gray-500">{{ $siswa->kelas->nama_kelas }} ({{ $siswa->semester_sekarang }})</span>
            </div>
        </div>
    </div>
    <form action="{{ route('siswa.profile-update') }}" method="POST">
        @csrf
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="mb-5">
                <label for="nama_siswa" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap Siswa</label>
                <input type="text" id="nama_siswa" name="nama_siswa" value="{{ $siswa->nama_siswa }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mb-5">
                <label for="nisn" class="block mb-2 text-sm font-medium text-gray-900">NISN</label>
                <input type="text" id="nisn" name="nisn" value="{{ $siswa->nisn }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Siswa</label>
                <input type="email" id="email" name="email" value="{{ $siswa->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mb-5">
                <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                <select type="text" id="jenis_kelamin" name="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="Laki-laki" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="mb-5">
                <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat Lahir</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ $siswa->tempat_lahir }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mb-5">
                <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $siswa->tanggal_lahir }}">
            </div>
            <div class="mb-5">
                <label for="agama" class="block mb-2 text-sm font-medium text-gray-900">Agama</label>
                <select type="text" id="agama" name="agama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="Islam" {{ $siswa->jenis_kelamin == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ $siswa->jenis_kelamin == 'Kristen' ? 'selected' : '' }}>jenis_kelamin</option>
                    <option value="Katolik" {{ $siswa->jenis_kelamin == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ $siswa->jenis_kelamin == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Budha" {{ $siswa->jenis_kelamin == 'Budha' ? 'selected' : '' }}>Budha</option>
                    <option value="Konghucu" {{ $siswa->jenis_kelamin == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>
        </div>
        <div class="flex mb-4">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Simpan</button>
        </div>
    </form>
</div>
@endsection