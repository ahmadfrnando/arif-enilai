@extends('guest.layouts.master')

@section('content')
<!-- Jumbotron -->
<section class="bg-center bg-no-repeat bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')] bg-gray-700 bg-blend-multiply">
    <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
        <h1 class="mb-4 text-4xl text-white font-extrabold tracking-tight leading-none md:text-5xl lg:text-6xl">
            Selamat Datang di SMA Kartika 1-2 Medan
        </h1>
        <p class="mb-8 text-white text-lg font-normal lg:text-xl sm:px-16 lg:px-48">
            SMA Kartika 1-2 Medan berkomitmen untuk mencetak generasi muda yang berprestasi, berkarakter, dan siap menghadapi tantangan global.
            Kami menyediakan pendidikan berkualitas yang didukung oleh fasilitas modern dan tenaga pendidik profesional.
        </p>
    </div>
</section>

<section id="about" class="bg-gray-100 py-16">
    <div class="px-4 mx-auto max-w-screen-xl text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Tentang Kami</h2>
        <p class="text-lg text-gray-600 leading-relaxed">
            SMA Kartika 1-2 Medan adalah lembaga pendidikan unggulan yang telah berdiri sejak tahun 2005.
            Kami berkomitmen untuk mencetak lulusan yang berprestasi baik di bidang akademik maupun non-akademik,
            dengan kurikulum yang berorientasi pada pengembangan potensi siswa.
        </p>
    </div>
</section>

<section class="p-6 bg-gray-100">
    <div class="container mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sidebar -->
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-center mb-4">
                <img src="{{ asset('logo.svg') }}" alt="Logo Sekolah" class="w-24 h-24 mx-auto rounded-full">
            </div>
            <div class="mt-6 space-y-4">

                <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Data Sekolah:</h2>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <li>
                        <strong>Kepsek:</strong> {{ $data->nama_kepsek ?? '-' }}
                    </li>
                    <li>
                        <strong>Operator:</strong> {{ $data->nama_operator ?? '-'}}
                    </li>
                    <li>
                        <strong>Akreditasi:</strong> {{ $data->akreditasi ?? '-' }}
                    </li>
                    <li>
                        <strong>Kurikulum:</strong> {{ $data->kurikulum ?? '-' }}
                    </li>
                    <li>
                        <strong>Waktu:</strong> {{ $data->waktu ?? '-' }}
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-span-2 bg-white p-6 rounded-lg shadow">

            <!-- Profil Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Identitas Sekolah -->
                <div class="bg-blue-100 p-4 rounded-lg">
                    <h3 class="text-lg font-bold mb-2">Identitas Sekolah</h3>
                    <p><strong>NPSN:</strong> {{ $data->npsn ?? '-' }}</p>
                    <p><strong>Status:</strong> {{ $data->status ?? '-' }}</p>
                    <p><strong>Bentuk Pendidikan:</strong> {{ $data->bentuk_pendidikan ?? '-' }}</p>
                    <p><strong>Status Kepemilikan:</strong> {{ $data->status_kepemilikan ?? '-' }}</p>
                    <p><strong>SK Pendirian Sekolah:</strong> {{ $data->sk_pendirian_sekolah ?? '-' }}</p>
                    <p><strong>Tanggal SK Pendirian:</strong> {{ $data->tanggal_sk_pendirian_sekolah ?? '-' }}</p>
                    <p><strong>SK Izin Operasional:</strong> {{ $data->sk_izin_operasional ?? '-' }}</p>
                    <p><strong>Tanggal SK Izin Operasional:</strong> {{ $data->tanggal_sk_izin_operasional ?? '-' }}</p>
                </div>

                <!-- Data Pelengkap -->
                <div class="bg-blue-100 p-4 rounded-lg">
                    <h3 class="text-lg font-bold mb-2">Data Pelengkap</h3>
                    <p><strong>Kebutuhan Khusus Dilayani:</strong> {{ $data->kebutuhan_khusus ?? '-' }}</p>
                    <p><strong>Nama Bank:</strong>{{ $data->nama_bank ?? '-' }}</p>
                    <p><strong>Cabang KCP/Unit:</strong> {{ $data->cabang_bank ?? '-' }}</p>
                    <p><strong>Rekening Atas Nama:</strong> {{ $data->nama_rekening ?? '-' }}</p>
                </div>

                <!-- Data Rinci -->
                <div class="bg-blue-100 p-4 rounded-lg md:col-span-2">
                    <h3 class="text-lg font-bold mb-2">Data Rinci</h3>
                    <p><strong>Status BOS:</strong> -</p>
                    <p><strong>Waktu Penyelenggaraan:</strong> -</p>
                    <p><strong>Sertifikasi ISO:</strong> -</p>
                    <p><strong>Sumber Listrik:</strong> -</p>
                    <p><strong>Daya Listrik:</strong> -</p>
                    <p><strong>Kecepatan Internet:</strong> -</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Tentang Kami -->


<!-- Fasilitas Sekolah -->
<section class="bg-white py-16">
    <div class="px-4 mx-auto max-w-screen-xl">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Fasilitas Sekolah</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-50 p-6 rounded-lg text-center">
                <h3 class="text-xl font-semibold text-gray-700">Laboratorium Modern</h3>
                <p class="text-gray-600 mt-4">Mendukung pembelajaran sains dan teknologi dengan peralatan terkini.</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg text-center">
                <h3 class="text-xl font-semibold text-gray-700">Perpustakaan Digital</h3>
                <p class="text-gray-600 mt-4">Ribuan koleksi buku untuk menunjang kegiatan belajar siswa.</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg text-center">
                <h3 class="text-xl font-semibold text-gray-700">Ruang Olahraga</h3>
                <p class="text-gray-600 mt-4">Fasilitas olahraga lengkap untuk mendukung kegiatan fisik siswa.</p>
            </div>
        </div>
    </div>
</section>

<!-- Galeri -->
<section id="gallery" class="bg-gray-100 py-16">
    <div class="px-4 mx-auto max-w-screen-xl">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Galeri Sekolah</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($galleries as $gallery)
            <img src="{{ asset('storage/' . $gallery->foto) }}" alt="Galeri {{ $gallery->title }}" class="w-full h-60 object-cover rounded-lg shadow">
            @endforeach
        </div>
    </div>
</section>

<!-- Kontak -->
<section id="contact" class="bg-blue-700 text-white py-16">
    <div class="px-4 mx-auto max-w-screen-xl">
        <h2 class="text-3xl font-bold text-center mb-8">Hubungi Kami</h2>
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-8 md:mb-0 text-center md:text-left">
                <h3 class="text-xl font-semibold">Alamat</h3>
                <p>Jl. Brigjend H.A Manaf Lubis, Helvetia Tengah, <br>Kec. Medan Helvetia, Kota Medan, Sumatera Utara 20124</p>
            </div>
            <form action="{{ route('kirim.pesan') }}" method="post" class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow-lg">
                @csrf
                <div class="mb-5">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="nama" id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div>
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div>
                <div class="mb-5">
                    <label for="pesan" class="block mb-2 text-sm font-medium text-gray-900">Pesan</label>
                    <textarea id="pesan" name="pesan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>

                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Kirim Pesan</button>
            </form>
        </div>
    </div>
</section>

<footer class="bg-gray-800 text-white py-4">
    <div class="px-4 mx-auto max-w-screen-xl text-center">
        <p>&copy; {{ date('Y') }} SMA Kartika 1-2 Medan. All rights reserved.</p>
    </div>
</footer>
@endsection