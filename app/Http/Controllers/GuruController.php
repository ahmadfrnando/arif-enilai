<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\NilaiKeterampilan;
use App\Models\NilaiPengetahuan;
use App\Models\RefKelas;
use App\Models\RefMapel;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {   
        $guru = Guru::where('id', Auth::user()->id_guru)->first();
        $user = Auth::user();
        return view('guru.dashboard', [
            'guru' => $guru,
        ]);
    }

    public function siswa()
    {
        $siswa = Siswa::paginate(10);
        $kelas = RefKelas::all();
        return view('guru.siswa.index', [
            'siswa' => $siswa,
            'kelas' => $kelas
        ]);
    }

    public function filterSiswa(Request $request)
    {
        $kelasId = $request->input('pilihKelas');

        $query = Siswa::query();
        if ($kelasId) {
            $query->where('id_kelas_sekarang', $kelasId);
        }

        $siswa = $query->paginate(10);

        $kelas = RefKelas::all();

        return view('guru.siswa.index', compact('siswa', 'kelas'));
    }

    public function cariSiswa(Request $request)
    {
        $cari = $request->cari;
        $siswa = Siswa::where('nama_siswa', 'like', '%' . $cari . '%')->paginate();
        $kelas = RefKelas::all();
        return view('guru.siswa.index', compact('siswa', 'kelas'));
    }

    public function cariNilaiPengetahuan(Request $request)
    {
        $cari = $request->cari;
        $siswa = Siswa::where('nama_siswa', 'like', '%' . $cari . '%')->paginate();
        $kelas = RefKelas::all();
        $id_guru = Auth::user()->id_guru;
        $guru = Guru::find($id_guru);
        $mapel = RefMapel::where('id', $guru->id_mapel)->first();
        return view('guru.nilai-pengetahuan.index', compact('siswa', 'kelas', 'mapel', 'id_guru'));
    }

    public function nilaiPengetahuan()
    {
        $id_guru = Auth::user()->id_guru;
        $guru = Guru::find($id_guru);
        $mapel = RefMapel::where('id', $guru->id_mapel)->first();
        $siswa = Siswa::paginate(10);
        $kelas = RefKelas::all();
        return view('guru.nilai-pengetahuan.index', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'mapel' => $mapel,
            'id_guru' => $id_guru
        ]);
    }

    public function cariNilaiKeterampilan(Request $request)
    {
        $cari = $request->cari;
        $siswa = Siswa::where('nama_siswa', 'like', '%' . $cari . '%')->paginate();
        $kelas = RefKelas::all();
        $id_guru = Auth::user()->id_guru;
        $guru = Guru::find($id_guru);
        $mapel = RefMapel::where('id', $guru->id_mapel)->first();
        return view('guru.nilai-keterampilan.index', compact('siswa', 'kelas', 'mapel', 'id_guru'));
    }

    public function filterNilaiPengetahuan(Request $request)
    {
        $kelasId = $request->input('pilihKelas');

        $query = Siswa::query();
        if ($kelasId) {
            $query->where('id_kelas_sekarang', $kelasId);
        }

        $siswa = $query->paginate(10);

        $kelas = RefKelas::all();

        $id_guru = Auth::user()->id_guru;
        $guru = Guru::find($id_guru);
        $mapel = RefMapel::where('id', $guru->id_mapel)->first();
        $kelas = RefKelas::all();

        return view('guru.nilai-pengetahuan.index', compact('siswa', 'kelas', 'mapel', 'id_guru'));
    }

    public function inputNilaiPengetahuan(Request $request)
    {
        try {

            $request->validate([
                'id_siswa' => 'required',
                'id_mapel' => 'required',
                'id_guru' => 'required',
                'id_kelas' => 'required',
                'nilai_pengetahuan' => 'required'
            ]);

            $predikat = '';
            $mapel = RefMapel::where('id', $request->id_mapel)->first();
            if ($mapel->kkm == 78) {
                if ($request->nilai_pengetahuan < 78) {
                    $predikat = 'D';
                } elseif ($request->nilai_pengetahuan >= 78 && $request->nilai_pengetahuan <= 79) {
                    $predikat = 'C';
                } elseif ($request->nilai_pengetahuan >= 80 && $request->nilai_pengetahuan <= 89) {
                    $predikat = 'B';
                } elseif ($request->nilai_pengetahuan >= 90 && $request->nilai_pengetahuan <= 100) {
                    $predikat = 'A';
                }
            } elseif($mapel->kkm == 82) {
                if ($request->nilai_pengetahuan < 82) {
                    $predikat = 'D';
                } elseif ($request->nilai_pengetahuan >= 82 && $request->nilai_pengetahuan <= 83) {
                    $predikat = 'C';
                } elseif ($request->nilai_pengetahuan >= 84 && $request->nilai_pengetahuan <= 89) {
                    $predikat = 'B';
                } elseif ($request->nilai_pengetahuan >= 90 && $request->nilai_pengetahuan <= 100) {
                    $predikat = 'A';
                }
            }

            NilaiPengetahuan::create([
                'id_siswa' => $request->id_siswa,
                'id_mapel' => $request->id_mapel,
                'id_guru' => $request->id_guru,
                'id_kelas' => $request->id_kelas,
                'nilai_pengetahuan' => $request->nilai_pengetahuan,
                'predikat' => $predikat
            ]);

            return redirect()->back()->with('success', 'Nilai berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function nilaiKeterampilan()
    {
        $id_guru = Auth::user()->id_guru;
        $guru = Guru::find($id_guru);
        $mapel = RefMapel::where('id', $guru->id_mapel)->first();
        $siswa = Siswa::paginate(10);
        $kelas = RefKelas::all();
        return view('guru.nilai-keterampilan.index', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'mapel' => $mapel,
            'id_guru' => $id_guru
        ]);
    }

    public function filterNilaiKeterampilan(Request $request)
    {
        $kelasId = $request->input('pilihKelas');

        $query = Siswa::query();
        if ($kelasId) {
            $query->where('id_kelas_sekarang', $kelasId);
        }

        $siswa = $query->paginate(10);

        $kelas = RefKelas::all();

        $id_guru = Auth::user()->id_guru;
        $guru = Guru::find($id_guru);
        $mapel = RefMapel::where('id', $guru->id_mapel)->first();
        $kelas = RefKelas::all();

        return view('guru.nilai-keterampilan.index', compact('siswa', 'kelas', 'mapel', 'id_guru'));
    }

    public function inputNilaiKeterampilan(Request $request)
    {
        try {
            $request->validate([
                'id_siswa' => 'required',
                'id_mapel' => 'required',
                'id_guru' => 'required',
                'id_kelas' => 'required',
                'nilai_keterampilan' => 'required'
            ]);

            $predikat = '';
            $mapel = RefMapel::where('id', $request->id_mapel)->first();
            if ($mapel->kkm == 78) {
                if ($request->nilai_pengetahuan < 78) {
                    $predikat = 'D';
                } elseif ($request->nilai_pengetahuan >= 78 && $request->nilai_pengetahuan <= 79) {
                    $predikat = 'C';
                } elseif ($request->nilai_pengetahuan >= 80 && $request->nilai_pengetahuan <= 89) {
                    $predikat = 'B';
                } elseif ($request->nilai_pengetahuan >= 90 && $request->nilai_pengetahuan <= 100) {
                    $predikat = 'A';
                }
            } elseif($mapel->kkm == 82) {
                if ($request->nilai_pengetahuan < 82) {
                    $predikat = 'D';
                } elseif ($request->nilai_pengetahuan >= 82 && $request->nilai_pengetahuan <= 83) {
                    $predikat = 'C';
                } elseif ($request->nilai_pengetahuan >= 84 && $request->nilai_pengetahuan <= 89) {
                    $predikat = 'B';
                } elseif ($request->nilai_pengetahuan >= 90 && $request->nilai_pengetahuan <= 100) {
                    $predikat = 'A';
                }
            }

            NilaiKeterampilan::create([
                'id_siswa' => $request->id_siswa,
                'id_mapel' => $request->id_mapel,
                'id_guru' => $request->id_guru,
                'id_kelas' => $request->id_kelas,
                'nilai_keterampilan' => $request->nilai_keterampilan,
                'predikat' => $predikat
            ]);

            return redirect()->back()->with('success', 'Nilai berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function kelas()
    {
        $kelas = RefKelas::all();
        return view('guru.kelas.index', [
            'kelas' => $kelas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGuruRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGuruRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGuruRequest  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGuruRequest $request, Guru $guru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        //
    }
}
