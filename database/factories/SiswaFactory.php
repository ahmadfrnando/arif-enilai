<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_siswa' => $this->faker->name(),
            'nisn' => $this->faker->unique()->numerify('#########'),
            'email' => $this->faker->unique()->safeEmail(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date('Y-m-d', '2005-01-01'),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']),
            'anak_ke' => $this->faker->randomDigitNotNull(),
            'status_dalam_keluarga' => $this->faker->randomElement(['Anak Kandung', 'Anak Tiri', 'Anak Angkat']),
            'alamat_siswa' => $this->faker->address(),
            'telepon_siswa' => $this->faker->phoneNumber(),
            'id_kelas_pertama' => $this->faker->numberBetween(1, 12), // asumsikan id_kelas_pertama ada di tabel kelas
            'id_kelas_sekarang' => $this->faker->numberBetween(1, 12), // asumsikan id_kelas_pertama ada di tabel kelas
            'tanggal_pertama_diterima' => $this->faker->date('Y-m-d', '2021-01-01'),
            'semester_pertama_diterima' => $this->faker->randomElement(['1', '2']),
            'asal_sekolah' => $this->faker->company(),
            'tahun_ijazah' => $this->faker->year(),
            'nomor_ijazah' => $this->faker->unique()->numerify('IJ#######'),
            'tahun_shun' => $this->faker->year(),
            'nomor_shun' => $this->faker->unique()->numerify('SHUN#######'),
            'nama_ayah' => $this->faker->name(),
            'nama_ibu' => $this->faker->name(),
            'pekerjaan_ayah' => $this->faker->jobTitle(),
            'pekerjaan_ibu' => $this->faker->jobTitle(),
            'alamat_ortu' => $this->faker->address(),
            'telepon_ortu' => $this->faker->phoneNumber(),
            'nama_wali' => $this->faker->optional()->name(),
            'pekerjaan_wali' => $this->faker->optional()->jobTitle(),
            'alamat_wali' => $this->faker->optional()->address(),
            'telepon_wali' => $this->faker->optional()->phoneNumber(),
            'created_at' => now(),
            'updated_at' => now(),
            'semester_sekarang' => 1,
        ];
    }
}
