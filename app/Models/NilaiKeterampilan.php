<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiKeterampilan extends Model
{
    use HasFactory;

    protected $table = 'nilai_keterampilan';
    protected $guarded = [];

    public static function calculatePredikat($kkm, $nilai_keterampilan)
    {
        if ($kkm == 78) {
            if ($nilai_keterampilan < 78) {
                return 'D';
            } elseif ($nilai_keterampilan >= 78 && $nilai_keterampilan <= 79) {
                return 'C';
            } elseif ($nilai_keterampilan >= 80 && $nilai_keterampilan <= 89) {
                return 'B';
            } elseif ($nilai_keterampilan >= 90 && $nilai_keterampilan <= 100) {
                return 'A';
            }
        } elseif ($kkm == 82) {
            if ($nilai_keterampilan < 82) {
                return 'D';
            } elseif ($nilai_keterampilan >= 82 && $nilai_keterampilan <= 83) {
                return 'C';
            } elseif ($nilai_keterampilan >= 84 && $nilai_keterampilan <= 89) {
                return 'B';
            } elseif ($nilai_keterampilan >= 90 && $nilai_keterampilan <= 100) {
                return 'A';
            }
        }
        return null; // Default jika tidak ada kriteria
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($nilaiKeterampilan) {
            $mapel = RefMapel::find($nilaiKeterampilan->id_mapel);
            if ($mapel) {
                $nilaiKeterampilan->predikat = self::calculatePredikat($mapel->kkm, $nilaiKeterampilan->nilai_keterampilan);
            }
        });

        static::updating(function ($nilaiKeterampilan) {
            $mapel = RefMapel::find($nilaiKeterampilan->id_mapel);
            if ($mapel) {
                $nilaiKeterampilan->predikat = self::calculatePredikat($mapel->kkm, $nilaiKeterampilan->nilai_keterampilan);
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
