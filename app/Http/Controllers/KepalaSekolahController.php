<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\NilaiKeterampilan;
use App\Models\NilaiPengetahuan;
use App\Models\NilaiSiswa;
use App\Models\RefKelas;
use App\Models\RefMapel;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KepalaSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function gantiPassword()
    {   
        $user = User::where('id', Auth::user()->id)->first();
        return view('kepsek.ganti-password', compact('user'));
    }

    public function gantiPasswordStore(Request $request)
    {   
        try {
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password'
            ]);
    
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
    
            return redirect()->back()->with('success', 'Password berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'password tidak sama '. $th->getMessage());
        }
    }

    public function siswa(Request $request)
    {
        $siswa = Siswa::query();
        if ($request->cari) {
            $siswa->where('nama_siswa', 'like', '%' . $request->cari . '%')->orWhere('nisn', 'like', '%' . $request->cari . '%');
        }
        if ($request->input('pilihKelas')) {
            $siswa->where('id_kelas_sekarang', $request->input('pilihKelas'));
        }
        $siswa = $siswa->paginate(10);
        $kelas = RefKelas::all();
        return view('kepsek.siswa.index', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'cari' => $request->cari
        ]);
    }

    public function guru(Request $request)
    {
        $guru = Guru::query();

        if ($request->cari) {
            $guru->where('nama_guru', 'like', '%' . $request->cari . '%')->orWhere('nip', 'like', '%' . $request->cari . '%');
        }

        $guru = $guru->paginate(10);
        return view('kepsek.guru.index', [
            'guru' => $guru,
            'cari' => $request->cari,
        ]);
    }

    public function kelas()
    {
        $kelas = RefKelas::all();
        $siswa = Siswa::all()->count();
        return view('kepsek.kelas.index', [
            'kelas' => $kelas,
            'siswa' => $siswa
        ]);
    }

    public function dashboard()
    {
        $mapel = RefMapel::paginate(5);
        $siswa = Siswa::all()->count();
        $guru = Guru::all()->count();

        return view('kepsek.dashboard', compact('siswa', 'guru'));
    }


    public function nilaiPengetahuan(Request $request)
    {
        $kelasId = $request->input('pilihKelas');
        $semester = $request->input('pilihSemester');
        $mapelId = $request->input('pilihMapel');
        $cari = $request->input('cari');

        $query = NilaiSiswa::query()->with('siswa');

        if ($kelasId) {
            $query->where('id_kelas', $kelasId);
        }
        if ($semester) {
            $query->where('semester_id', $semester);
        }
        if ($mapelId) {
            $query->where('id_mapel', $mapelId);
        }
        if ($cari) {
            $query->whereHas('siswa', function ($q) use ($cari) {
                $q->where('nama_siswa', 'like', '%' . $cari . '%');
            });
        }

        $nilaiPengetahuan = $query->paginate(10);

        $kelas = RefKelas::all();
        $mapel = RefMapel::all();
        return view('kepsek.nilai-pengetahuan.index', compact('nilaiPengetahuan', 'kelas', 'mapel'));
    }

    public function nilaiKeterampilan(Request $request)
    {
        $kelasId = $request->input('pilihKelas');
        $semester = $request->input('pilihSemester');
        $mapelId = $request->input('pilihMapel');
        $cari = $request->input('cari');

        $query = NilaiSiswa::query()->with('siswa');

        if ($kelasId) {
            $query->where('id_kelas', $kelasId);
        }
        if ($semester) {
            $query->where('semester_id', $semester);
        }
        if ($mapelId) {
            $query->where('id_mapel', $mapelId);
        }
        if ($cari) {
            $query->whereHas('siswa', function ($q) use ($cari) {
                $q->where('nama_siswa', 'like', '%' . $cari . '%');
            });
        }

        $nilaiKeterampilan = $query->paginate(10);

        $kelas = RefKelas::all();
        $mapel = RefMapel::all();
        return view('kepsek.nilai-keterampilan.index', compact('nilaiKeterampilan', 'kelas', 'mapel'));
    }

    

    public function report()
    {
        return view('siswa.report.index');
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
     * @param  \App\Http\Requests\StoreSiswaRequest  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaRequest  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }
}
