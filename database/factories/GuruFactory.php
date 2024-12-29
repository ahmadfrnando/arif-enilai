<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;
        $nip = $this->generateNip($faker);
        return [
            'nip' => $nip,
            'nama_guru' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date('Y-m-d', '1980-01-01'),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']),
            'tanggal_mulai_tugas' => $this->faker->date('Y-m-d', '2010-01-01'),
            'jabatan' => $this->faker->jobTitle(),
            'jenis_sekolah' => $this->faker->randomElement(['SD', 'SMP', 'SMA']),
            'jurusan' => $this->faker->randomElement(['IPA', 'IPS', 'Bahasa Indonesia', 'Matematika', 'Fisika', 'Kimia', 'Bahasa Inggris']),
            'tahun_sttb' => $this->faker->year(),
            'id_mapel' => $this->faker->numberBetween(1, 14),
            'penataran_yang_pernah_diikutin' => $this->faker->optional()->sentence(),
            'keterangan' => $this->faker->optional()->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function generateNip($faker)
    {
        // Tahun lahir antara 1970 dan 2000
        $year = $faker->numberBetween(1970, 2000);
        // Bulan lahir antara 1 dan 12
        $month = $faker->numberBetween(1, 12);
        // Hari lahir antara 1 dan 28
        $day = $faker->numberBetween(1, 28);
        // Nomor unik 2 digit
        $unique_number = $faker->numberBetween(10, 99);

        // Format NIP
        return sprintf("%04d%02d%02d%02d", $year, $month, $day, $unique_number);
    }
}
