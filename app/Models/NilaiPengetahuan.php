<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPengetahuan extends Model
{
    use HasFactory;

    protected $table = 'nilai_pengetahuan';
    protected $guarded = [];

    public static function calculatePredikat($kkm, $nilai_pengetahuan)
    {
        if ($kkm == 78) {
            if ($nilai_pengetahuan < 78) {
                return 'D';
            } elseif ($nilai_pengetahuan >= 78 && $nilai_pengetahuan <= 79) {
                return 'C';
            } elseif ($nilai_pengetahuan >= 80 && $nilai_pengetahuan <= 89) {
                return 'B';
            } elseif ($nilai_pengetahuan >= 90 && $nilai_pengetahuan <= 100) {
                return 'A';
            }
        } elseif ($kkm == 82) {
            if ($nilai_pengetahuan < 82) {
                return 'D';
            } elseif ($nilai_pengetahuan >= 82 && $nilai_pengetahuan <= 83) {
                return 'C';
            } elseif ($nilai_pengetahuan >= 84 && $nilai_pengetahuan <= 89) {
                return 'B';
            } elseif ($nilai_pengetahuan >= 90 && $nilai_pengetahuan <= 100) {
                return 'A';
            }
        }
        return null; // Default jika tidak ada kriteria
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($nilaiPengetahuan) {
            $mapel = RefMapel::find($nilaiPengetahuan->id_mapel);
            if ($mapel) {
                $nilaiPengetahuan->predikat = self::calculatePredikat($mapel->kkm, $nilaiPengetahuan->nilai_pengetahuan);
            }
        });

        static::updating(function ($nilaiPengetahuan) {
            $mapel = RefMapel::find($nilaiPengetahuan->id_mapel);
            if ($mapel) {
                $nilaiPengetahuan->predikat = self::calculatePredikat($mapel->kkm, $nilaiPengetahuan->nilai_pengetahuan);
            }
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
