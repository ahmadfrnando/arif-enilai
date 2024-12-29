<?php

namespace Database\Seeders;

use App\Models\RefMapel;
use App\Models\RefTahunAjaran;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefTahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = [
            1,2,3,4,5,6,7,8,9,10
        ];

        $tahun_ajaran = [
            '2023/2024',
            '2024/2025',
            '2025/2026',
            '2026/2027',
            '2027/2028',
            '2028/2029',
            '2029/2030',
            '2030/2031',
            '2031/2032',
            '2032/2033'
        ];

        $data = array_map(function ($id, $tahun_ajaran) {
            return [
                'id' => $id,
                'tahun_ajaran' => $tahun_ajaran,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }, $id, $tahun_ajaran);

        RefTahunAjaran::insert($data);

    }
}
