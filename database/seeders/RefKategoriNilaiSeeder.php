<?php

namespace Database\Seeders;

use App\Models\RefKategoriNilai;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefKategoriNilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $kategori = [
            'Nilai Pengetahuan',
            'Nilai Keterampilan',
        ];

        $data = array_map(function ($kategori) {
            return [
                'nama_kategori_nilai' => $kategori,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }, $kategori);

        RefKategoriNilai::insert($data);
    }
}
