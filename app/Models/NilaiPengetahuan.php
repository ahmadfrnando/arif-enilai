<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPengetahuan extends Model
{
    use HasFactory;

    protected $table = 'nilai_pengetahuan';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        // Event created: dijalankan setelah data siswa ditambahkan
        static::creating(function ($nilaiPengetahuan) {
            $mapel = RefMapel::where('id', $nilaiPengetahuan->id_mapel)->first();
            if ($mapel->kkm == 78) {
                if ($nilaiPengetahuan->nilai_pengetahuan < 78) {
                    $nilaiPengetahuan->predikat = 'D';
                } elseif ($nilaiPengetahuan->nilai_pengetahuan >= 78 && $nilaiPengetahuan->nilai_pengetahuan <= 79) {
                    $nilaiPengetahuan->predikat = 'C';
                } elseif ($nilaiPengetahuan->nilai_pengetahuan >= 80 && $nilaiPengetahuan->nilai_pengetahuan <= 89) {
                    $nilaiPengetahuan->predikat = 'B';
                } elseif ($nilaiPengetahuan->nilai_pengetahuan >= 90 && $nilaiPengetahuan->nilai_pengetahuan <= 100) {
                    $nilaiPengetahuan->predikat = 'A';
                }
            } elseif ($mapel->kkm == 82) {
                if ($nilaiPengetahuan->nilai_pengetahuan < 82) {
                    $nilaiPengetahuan->predikat = 'D';
                } elseif ($nilaiPengetahuan->nilai_pengetahuan >= 82 && $nilaiPengetahuan->nilai_pengetahuan <= 83) {
                    $nilaiPengetahuan->predikat = 'C';
                } elseif ($nilaiPengetahuan->nilai_pengetahuan >= 84 && $nilaiPengetahuan->nilai_pengetahuan <= 89) {
                    $nilaiPengetahuan->predikat = 'B';
                } elseif ($nilaiPengetahuan->nilai_pengetahuan >= 90 && $nilaiPengetahuan->nilai_pengetahuan <= 100) {
                    $nilaiPengetahuan->predikat = 'A';
                }
            }
            $nilaiPengetahuan->save();
        });
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(RefKelas::class, 'id_kelas', 'id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo(RefMapel::class, 'id_mapel', 'id');
    }
}
