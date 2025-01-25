<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\NilaiKeterampilan;
use App\Models\NilaiPengetahuan;
use App\Models\NilaiSiswa;
use App\Models\RefKelas;
use App\Models\RefMapel;
use App\Models\RefTahunAjaran;
use App\Models\ReportAkademikSiswa;
use App\Models\Siswa;
use App\Models\SiswaLulus;
use App\Models\SiswaLulusMapel;
use App\Models\SiswaLulusSemester;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;
// use Alert;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;


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
        $nilaiPengetahuan = NilaiSiswa::where('id_guru', Auth::user()->id_guru)
            ->whereNotNull('nilai_pengetahuan')
            ->count();
        $nilaiKeterampilan = NilaiSiswa::where('id_guru', Auth::user()->id_guru)
            ->whereNotNull('nilai_keterampilan')
            ->count();
        $kelas = RefKelas::all()->count();
        $siswa = Siswa::all()->count();
        $belumNilaiPengetahuan = 0;
        $belumNilaiKeterampilan = 0;

        return view('guru.dashboard', compact('nilaiPengetahuan', 'nilaiKeterampilan', 'kelas', 'siswa', 'guru', 'belumNilaiPengetahuan', 'belumNilaiKeterampilan'));
    }

    public function lulusSemester()
    {
        $guru = Guru::where('id', Auth::user()->id_guru)->first();
        $waliKelas = WaliKelas::where('id_guru', $guru->id)->first();
        $siswa = Siswa::where('id_kelas_sekarang', $waliKelas->id_kelas)->paginate(10);
        $mapel = RefMapel::all();

        $siswaLulusSemester = Siswa::with('siswaLulusSemester')->where('id_kelas_sekarang', $waliKelas->id_kelas)->paginate(10);
        return view('guru.verifikasi-kelulusan', compact('siswa', 'waliKelas', 'mapel', 'siswaLulusSemester'));
    }

    public function lulusSemesterDetail(Request $request)
    {
        $id_siswa = $request->id_siswa;

        $siswa = Siswa::findOrFail($id_siswa);

        $siswaLulusMapel = SiswaLulusMapel::with([
            'mapel',
            'mapel.nilaiPengetahuan',
            'mapel.nilaiKeterampilan'
        ])->where('id_siswa', $id_siswa)->get();

        $cekLulusMapel = RefMapel::whereNotIn('id', function ($query) use ($id_siswa) {
            $query->select('id_mapel')->from('siswa_lulus_mapel')->where('id_siswa', $id_siswa);
        })->get();

        $pilihTahunAjaran = RefTahunAjaran::all();

        $cekLulusSemester = SiswaLulusSemester::where('id_siswa', $id_siswa)
            ->where('id_kelas', $siswa->id_kelas_sekarang)
            ->where('semester', $siswa->semester_sekarang)
            ->first();

        // $dataNilaiMapel = siswaLulusMapel::with([
        //     'nilaiPengetahuan',
        //     'nilaiKeterampilan',
        //     'mapel'
        // ])->where('id_siswa', $id_siswa)->get();

        return view('guru.detail-lulus-semester', compact('siswa', 'siswaLulusMapel', 'cekLulusMapel', 'pilihTahunAjaran', 'cekLulusSemester'));
    }

    public function inputLulusSemester(Request $request)
    {
        $nama_status = 'Lulus';
        $alasan = $request->alasan ?? null;
        $pesan = "";

        try {
            $request->validate([
                'id_siswa' => 'required',
                'semester' => 'required',
                'id_kelas' => 'required',
                'id_guru' => 'required',
                "id_status" => 'required',
                'tahun_ajaran' => 'required'
            ]);

            if ($request->has('alasan')) {
                $request->validate(['alasan' => 'required']);
                $nama_status = 'Tidak Lulus';
                $alasan = $request->alasan;
                $pesan = $alasan;
            }

            if ($request->has('pesan')) {
                $request->validate(['pesan' => 'required']);
                $pesan = $request->pesan;
            }

            $buatLulusSemester = SiswaLulusSemester::create([
                'id_siswa' => $request->id_siswa,
                'semester' => $request->semester,
                'id_kelas' => $request->id_kelas,
                'id_guru' => $request->id_guru,
                'id_status' => $request->id_status,
                'nama_status' => $nama_status,
                'alasan' => $alasan
            ]);

            $tahunAjaran = RefTahunAjaran::find($request->tahun_ajaran)->tahun_ajaran;
            $nama_siswa = Siswa::find($request->id_siswa)->nama_siswa;
            $nama_kelas = RefKelas::find($request->id_kelas)->nama_kelas;
            $nama_guru = Guru::find($request->id_guru)->nama_guru;
            $nama_semester = Siswa::find($request->id_siswa)->semester_sekarang;
            $siswaLulusMapel = SiswaLulusMapel::with([
                'mapel.nilaiPengetahuan',
                'mapel.nilaiKeterampilan'
            ])->where('id_siswa', $request->id_siswa)->get();

            $dataNilai = [];
            foreach ($siswaLulusMapel as $s) {
                $dataNilai[] = [
                    [
                        'nama_mapel' => $s->mapel->nama_mapel_lengkap,
                        'kkm' => $s->mapel->kkm,
                        'pengetahuan' => [
                            'nilai' => $s->mapel->nilaiPengetahuan->nilai_pengetahuan,
                            'predikat' => $s->mapel->nilaiPengetahuan->predikat
                        ],
                        'keterampilan' => [
                            'nilai' => $s->mapel->nilaiKeterampilan->nilai_keterampilan,
                            'predikat' => $s->mapel->nilaiKeterampilan->predikat
                        ],
                    ]
                ];
            }

            if ($buatLulusSemester) {
                ReportAkademikSiswa::create([
                    'tahun_ajaran' => $tahunAjaran,
                    'id_siswa' => $request->id_siswa,
                    'nama_siswa' => $nama_siswa,
                    'id_kelas' => $request->id_kelas,
                    'nama_kelas' => $nama_kelas,
                    'id_guru' => $request->id_guru,
                    'nama_guru' => $nama_guru,
                    'nama_semester' => $nama_semester,
                    'status' => $nama_status,
                    'nilai' => $dataNilai,
                    'pesan' => $pesan,
                ]);
            }

            return redirect()->back()->with('success', 'Siswa Lulus Semester Berhasil Direkam');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Siswa Lulus Semester Gagal Direkam: ' . $th->getMessage());
        }
    }



    public function profile()
    {
        $guru = Guru::where('id', Auth::user()->id_guru)->first();
        return view('guru.profile', compact('guru'));
    }

    public function profileUpdate(Request $request)
    {
        $guru = Guru::where('id', Auth::user()->id_guru)->first();
        $guru->update([
            'nama_guru' => $request->nama_guru,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
        ]);
        return redirect()->route('guru.profile')->with('success', 'Data Guru Berhasil Diupdate');
    }

    public function detailSiswa(Request $request) //8
    {
        // $siswaId = Siswa::where('id', $request->id)->first();
        // $siswa = Siswa::find($siswaId);
        $nilaiSiswa = NilaiSiswa::find($request->id);

        $cekSiswaLulus = $nilaiSiswa->where('status_lulus_mapel', 1)->first();
        $guru = Guru::find(Auth::user()->id_guru);
        $kelas = RefKelas::all();
        $nilaiPengetahuan = $nilaiSiswa->where('id', $request->id)->where('nilai_pengetahuan', '!=', null)->first();
        $nilaiKeterampilan = $nilaiSiswa->where('id', $request->id)->where('nilai_keterampilan', '!=', null)->first();
        return view('guru.siswa.detail', compact('nilaiSiswa', 'kelas', 'nilaiKeterampilan', 'nilaiPengetahuan', 'guru', 'cekSiswaLulus'));
    }

    public function siswa(Request $request)
    {
        $id_guru = Auth::user()->id_guru;
        $nilaiSiswa = NilaiSiswa::where('id_guru', $id_guru);
        if ($request->cari) {
            $nilaiSiswa->whereHas('siswa', function ($query) use ($request) {
                $query->where('nama_siswa', 'like', '%' . $request->cari . '%')
                    ->orWhere('nisn', 'like', '%' . $request->cari . '%');
            });
        }
        if ($request->input('pilihKelas')) {
            $nilaiSiswa->where('id_kelas', $request->input('pilihKelas'));
        }
        $nilaiSiswa = $nilaiSiswa->paginate(10);
        $kelas = RefKelas::all();
        $guru = Guru::where('id', $id_guru)->first();
        return view('guru.siswa.index', [
            'nilaiSiswa' => $nilaiSiswa,
            'kelas' => $kelas,
            'guru' => $guru,
        ]);
    }

    public function siswaLulus(Request $request)
    {
        try {
            $request->validate([
                'status_lulus_mapel' => 'required',
            ]);
            $nilaiSiswa = NilaiSiswa::find($request->id);
            $nama_status = '';
            if ($request->status_lulus_mapel == 1) {
                $nama_status = 'Lulus';
            } else {
                $nama_status = 'Tidak Lulus';
            }
            $nilaiSiswa->update([
                'status_lulus_mapel' => $request->status_lulus_mapel,
                'nama_status_lulus_mapel' => $nama_status,
                'alasan_tidak_lulus' => $request->alasan_tidak_lulus ?? '',
            ]);
            return redirect()->back()->with('success', 'Data Kelulusan Berhasil Direkam');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Siswa Lulus Gagal Direkam: ' . $th->getMessage());
        }
    }

    public function nilaiPengetahuan(Request $request)
    {
        $id_guru = Auth::user()->id_guru;
        $guru = Guru::find($id_guru);
        $mapel = RefMapel::where('id', $guru->id_mapel)->first();
        $siswa = Siswa::query();
        $kelas = RefKelas::all();
        if ($request->cari) {
            // $siswa->where('nama_siswa', 'like', '%' . $request->cari . '%')->orWhere('id', 'like', '%' . $request->cari . '%');
            $siswa->where(function ($query) use ($request) {
                $query->where('nama_siswa', 'like', '%' . $request->cari . '%')
                    ->orWhere('id', 'like', '%' . $request->cari . '%');
            });
        }
        if ($request->input('pilihKelas')) {
            $siswa->where('id_kelas_sekarang', $request->input('pilihKelas'));
        }
        if ($request->input('pilihSemester')) {
            $siswa->where('semester_sekarang', $request->input('pilihSemester'));
        }

        $siswa = $siswa->with(['nilaiSiswa' => function ($query) use ($mapel) {
            $query->where('id_mapel', $mapel->id);
        }])->paginate(10);


        return view('guru.nilai-pengetahuan.index', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'mapel' => $mapel,
            'id_guru' => $id_guru,
        ]);
    }

    public function inputNilaiPengetahuan(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_siswa' => 'required|exists:siswa,id',
                'id_mapel' => 'required|exists:ref_mapel,id',
                'id_guru' => 'required|exists:guru,id',
                'id_kelas' => 'required|exists:ref_kelas,id',
                'semester_sekarang' => 'required',
                'nilai_pengetahuan' => 'required|integer|min:0|max:100'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Masukkan data nilai dari 0 sampai 100');
            }

            $predikat = '';
            $mapel = RefMapel::findOrFail($request->id_mapel);
            $siswa = Siswa::findOrFail($request->id_siswa);
            $predikat = NilaiSiswa::calculatePredikatPengetahuan($mapel->kkm, $request->nilai_pengetahuan);

            $cekDataNilai = NilaiSiswa::where('id_siswa', $request->id_siswa)->where('id_mapel', $request->id_mapel)->where('id_guru', $request->id_guru)->where('id_kelas', $request->id_kelas)->where('semester_id', $request->semester_sekarang)->where('tahun_ajaran', $siswa->tahun_ajaran)->first();
            if ($cekDataNilai) {
                $cekDataNilai->update([
                    'nilai_pengetahuan' => $request->nilai_pengetahuan,
                    'predikat_pengetahuan' => $predikat,
                    'semester_id' => $request->semester_sekarang
                ]);

                return redirect()->back()->with('success', 'Nilai berhasil diperbarui');
            } else {
                NilaiSiswa::create([
                    'id_siswa' => $request->id_siswa,
                    'id_mapel' => $request->id_mapel,
                    'id_guru' => $request->id_guru,
                    'id_kelas' => $request->id_kelas,
                    'nilai_pengetahuan' => $request->nilai_pengetahuan,
                    'predikat_pengetahuan' => $predikat,
                    'semester_id' => $request->semester_sekarang,
                    'tahun_ajaran' => $siswa->tahun_ajaran,
                    'status_lulus_mapel' => 1
                ]);

                return redirect()->back()->with('success', 'Nilai berhasil disimpan');
            }

            return redirect()->back()->with('success', 'Nilai berhasil direkam.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during the creation!');
        }
    }

    public function nilaiKeterampilan(Request $request)
    {
        $id_guru = Auth::user()->id_guru;
        $guru = Guru::find($id_guru);
        $mapel = RefMapel::where('id', $guru->id_mapel)->first();
        $siswa = Siswa::query();
        $kelas = RefKelas::all();
        if ($request->cari) {
            // $siswa->where('nama_siswa', 'like', '%' . $request->cari . '%')->orWhere('id', 'like', '%' . $request->cari . '%');
            $siswa->where(function ($query) use ($request) {
                $query->where('nama_siswa', 'like', '%' . $request->cari . '%')
                    ->orWhere('id', 'like', '%' . $request->cari . '%');
            });
        }
        if ($request->input('pilihKelas')) {
            $siswa->where('id_kelas_sekarang', $request->input('pilihKelas'));
        }
        if ($request->input('pilihSemester')) {
            $siswa->where('semester_sekarang', $request->input('pilihSemester'));
        }

        $siswa = $siswa->with(['nilaiSiswa' => function ($query) use ($mapel) {
            $query->where('id_mapel', $mapel->id);
        }])->paginate(10);


        return view('guru.nilai-keterampilan.index', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'mapel' => $mapel,
            'id_guru' => $id_guru,
        ]);
    }

    // public function nilaiKeterampilan(Request $request)
    // {
    //     $id_guru = Auth::user()->id_guru;
    //     $guru = Guru::find($id_guru);
    //     $mapel = RefMapel::where('id', $guru->id_mapel)->first();
    //     $siswa = Siswa::query();

    //     if ($request->cari) {
    //         $siswa->where('nama_siswa', 'like', '%' . $request->cari . '%')->orWhere('id', 'like', '%' . $request->cari . '%');
    //     }
    //     if ($request->input('pilihKelas')) {
    //         $siswa->where('id_kelas_sekarang', $request->input('pilihKelas'));
    //     }
    //     if ($request->input('pilihSemester')) {
    //         $siswa->where('semester_sekarang', $request->input('pilihSemester'));
    //     }

    //     $siswa = $siswa->paginate(10);
    //     $kelas = RefKelas::all();

    //     return view('guru.nilai-keterampilan.index', [
    //         'siswa' => $siswa,
    //         'kelas' => $kelas,
    //         'mapel' => $mapel,
    //         'id_guru' => $id_guru
    //     ]);
    // }

    public function inputNilaiKeterampilan(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_siswa' => 'required|exists:siswa,id',
                'id_mapel' => 'required|exists:ref_mapel,id',
                'id_guru' => 'required|exists:guru,id',
                'id_kelas' => 'required|exists:ref_kelas,id',
                'semester_sekarang' => 'required',
                'nilai_keterampilan' => 'required|integer|min:0|max:100'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Masukkan data nilai dari 0 sampai 100');
            }

            $mapel = RefMapel::findOrFail($request->id_mapel);
            $siswa = Siswa::findOrFail($request->id_siswa);
            $predikat = NilaiSiswa::calculatePredikatKeterampilan($mapel->kkm, $request->nilai_keterampilan);

            $cekDataNilai = NilaiSiswa::where('id_siswa', $request->id_siswa)
                ->where('id_mapel', $request->id_mapel)
                ->where('id_guru', $request->id_guru)
                ->where('id_kelas', $request->id_kelas)
                ->where('semester_id', $request->semester_sekarang)
                ->where('tahun_ajaran', $siswa->tahun_ajaran)
                ->first();

            if ($cekDataNilai) {
                $cekDataNilai->update([
                    'nilai_keterampilan' => $request->nilai_keterampilan,
                    'predikat_keterampilan' => $predikat,
                    'semester_id' => $request->semester_sekarang
                ]);

                return redirect()->back()->with('success', 'Nilai berhasil diperbarui');
            } else {
                NilaiSiswa::create([
                    'id_siswa' => $request->id_siswa,
                    'id_mapel' => $request->id_mapel,
                    'id_guru' => $request->id_guru,
                    'id_kelas' => $request->id_kelas,
                    'nilai_keterampilan' => $request->nilai_keterampilan,
                    'predikat_keterampilan' => $predikat,
                    'semester_id' => $request->semester_sekarang,
                    'tahun_ajaran' => $siswa->tahun_ajaran,
                    'status_lulus_mapel' => 1
                ]);

                return redirect()->back()->with('success', 'Nilai berhasil disimpan');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during the creation: ' . $e->getMessage());
        }
    }

    public function gantiPassword()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('guru.ganti-password', compact('user'));
    }

    public function gantiPasswordUpdate(Request $request)
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
            return redirect()->back()->with('error', 'password tidak sama ' . $th->getMessage());
        }
    }

    public function kelas()
    {
        $kelas = RefKelas::all();
        $siswa = Siswa::all()->count();
        return view('guru.kelas.index', [
            'kelas' => $kelas,
            'siswa' => $siswa
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
