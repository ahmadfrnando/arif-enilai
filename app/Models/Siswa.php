<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        // Event created: dijalankan setelah data siswa ditambahkan
        static::created(function ($siswa) {
            // Tambahkan row baru ke tabel users
            // dd($siswa->id);
            User::create([
                'name' => $siswa->nama_siswa,
                'email' => $siswa->email,
                'id_siswa' => $siswa->id,
                'role' => 'siswa',
                'password' => Hash::make('123'), // Password default
            ]);

            $jumlahSiswa = RefKelas::where('id', $siswa->id_kelas_sekarang)->first()->jumlah_siswa ?? 0;
            RefKelas::updateOrCreate([
                'id' => $siswa->id_kelas_sekarang,
            ], [
                'jumlah_siswa' => $jumlahSiswa + 1
            ]);
        });

        static::updated(function ($siswa) {
            $user = User::where('id_siswa', $siswa->id)->first();
            if ($user) {
                $user->update([
                    'name' => $siswa->nama_siswa,
                    'email' => $siswa->email,
                ]);
            }
        });
    }

    public function kelas_pertama()
    {
        return $this->belongsTo(RefKelas::class, 'id_kelas_pertama', 'id');
    }
    public function kelas()
    {
        return $this->belongsTo(RefKelas::class, 'id_kelas_sekarang', 'id');
    }

    public function siswaLulusSemester()
    {
        return $this->hasOne(SiswaLulusSemester::class, 'id_siswa', 'id');
    }

    public function nilaiPengetahuan()
    {
        return $this->hasMany(NilaiPengetahuan::class, 'id_siswa', 'id');
    }

    public function nilaiKeterampilan()
    {
        return $this->hasMany(NilaiKeterampilan::class, 'id_siswa', 'id');
    }
}
