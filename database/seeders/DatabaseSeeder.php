<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\RefKategoriNilai;
use App\Models\User;
use Illuminate\Database\Seeder;

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
            // SiswaSeeder::class,
            // RefKelasSeeder::class,
            // RefMapelSeeder::class,
            // RefKategoriNilaiSeeder::class,
            // GuruSeeder::class,
        ]);
        // User::factory()->create([
        //     'name' => 'admin',
        //     'username' => 'admin',
        //     'email' => 'admin@gmail.com',
        // ]);
    }
}
