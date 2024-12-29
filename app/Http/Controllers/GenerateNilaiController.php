<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\NilaiKeterampilan;
use App\Models\NilaiPengetahuan;
use App\Models\ReportNilaiSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;

class GenerateNilaiController extends Controller
{
    public function generate($id_ref_tahun_ajaran)
    {

        $siswa = Siswa::where('id_ref_tahun_ajaran', $id_ref_tahun_ajaran)->get();
        $nilaiPengetahuan = NilaiPengetahuan::where('id_ref_tahun_ajaran', $id_ref_tahun_ajaran)->get();
        $nilaiKeterampilan = NilaiKeterampilan::where('id_ref_tahun_ajaran', $id_ref_tahun_ajaran)->get();
        try {
            foreach ($siswa as $value) {
                $nilaiPengetahuan = $value->nilaiPengetahuan; // Relasi
                $nilaiKeterampilan = $value->nilaiKeterampilan; // Relasi
                $guru = $value->kelas->guru; // Relasi melalui kelas

                $data = [
                    'id_ref_tahun_ajaran' => $value->tahunAjaran->tahun_ajaran,
                    'id_siswa' => $value->id,
                    'nama_siswa' => $value->nama,
                    'id_guru' => $guru->id,
                    'nama_guru' => $guru->nama,
                    'id_semester' => $value->semester->id,
                    'semester' => $value->semester->nama,
                    'nilai_pengetahuan_agama' => $nilaiPengetahuan->agama ?? null,
                    'nilai_keterampilan_agama' => $nilaiKeterampilan->agama ?? null,
                ];

                ReportNilaiSiswa::create($data);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
