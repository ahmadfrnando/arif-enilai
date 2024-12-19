<?php

namespace Database\Seeders;

use App\Models\RefKelas;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $kelas = [
            'X IPA 1', 'X IPA 2', 'X IPS 1', 'X IPS 2',
            'XI IPA 1', 'XI IPA 2', 'XI IPS 1', 'XI IPS 2',
            'XII IPA 1', 'XII IPA 2', 'XII IPS 1', 'XII IPS 2',
        ];

        $data = array_map(function ($kelasName) {
            return [
                'nama_kelas' => $kelasName,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'jumlah_siswa' => 0
            ];
        }, $kelas);

        RefKelas::insert($data);
    }
}
