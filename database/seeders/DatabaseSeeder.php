<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\RefKategoriNilai;
use App\Models\SiswaLulusMapel;
use App\Models\SiswaLulusSemester;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // pertama ekeskusi
            // RefKelasSeeder::class,
            // RefMapelSeeder::class,
            // RefTahunAjaranSeeder::class,

            //kedua eksekusi
            // SiswaSeeder::class,
            // GuruSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
