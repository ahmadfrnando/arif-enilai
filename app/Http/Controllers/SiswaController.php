<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Guru;
use App\Models\NilaiKeterampilan;
use App\Models\NilaiPengetahuan;
use App\Models\RefKelas;
use App\Models\RefMapel;
use App\Models\ReportAkademikSiswa;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\ReportAkademikExport;
use App\Models\NilaiSiswa;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
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

    public function profile()
    {
        $siswa = Siswa::where('id', Auth::user()->id_siswa)->first();
        return view('siswa.profile', compact('siswa'));
    }

    public function profileUpdate(Request $request)
    {
        $siswa = Siswa::where('id', Auth::user()->id_siswa)->first();
        $siswa->update([
            'nama_siswa' => $request->nama_siswa,
            'email' => $request->email,
            'nisn' => $request->nisn,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
        ]);

        return redirect()->route('siswa.profile')->with('success', 'Data Guru Berhasil Diupdate');
    }

    public function password()
    {
        return view('siswa.password');
    }
    public function passwordUpdate(Request $request)
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

    public function dashboard()
    {
        $mapel = RefMapel::paginate(5);
        $siswa = Siswa::where('id', Auth::user()->id_siswa)->first();
        $nilaiPengetahuanTertinggi = NilaiSiswa::where('id_siswa', Auth::user()->id_siswa)->where('semester_id', $siswa->semester_sekarang)->where('id_kelas', $siswa->id_kelas_sekarang)->max('nilai_pengetahuan');
        $nilaiPengetahuanTerendah = NilaiSiswa::where('id_siswa', Auth::user()->id_siswa)->where('semester_id', $siswa->semester_sekarang)->where('id_kelas', $siswa->id_kelas_sekarang)->min('nilai_pengetahuan');
        $nilaiKeterampilanTertinggi = NilaiSiswa::where('id_siswa', Auth::user()->id_siswa)->where('semester_id', $siswa->semester_sekarang)->where('id_kelas', $siswa->id_kelas_sekarang)->max('nilai_keterampilan');
        $nilaiKeterampilanTerendah = NilaiSiswa::where('id_siswa', Auth::user()->id_siswa)->where('semester_id', $siswa->semester_sekarang)->where('id_kelas', $siswa->id_kelas_sekarang)->min('nilai_keterampilan');
        if (request()->ajax()) {
            return view('siswa.dashboard', compact('mapel', 'siswa', 'nilaiPengetahuanTertinggi', 'nilaiPengetahuanTerendah', 'nilaiKeterampilanTertinggi', 'nilaiKeterampilanTerendah'));
        }
        $nilaiSiswa = NilaiSiswa::where('id_siswa', Auth::user()->id_siswa)->where('semester_id', $siswa->semester_sekarang)->where('id_kelas', $siswa->id_kelas_sekarang)->paginate(5);

        return view('siswa.dashboard', compact('mapel', 'siswa', 'nilaiPengetahuanTertinggi', 'nilaiPengetahuanTerendah', 'nilaiKeterampilanTertinggi', 'nilaiKeterampilanTerendah', 'nilaiSiswa'));
    }

    public function nilai(Request $request)
    {
        // $mapel = collect(); // Default kosong
        // $kelas = RefKelas::all();
        $mapel = RefMapel::all();
        $siswa = Siswa::where('id', Auth::user()->id_siswa)->first();
        $nilaiSiswa = NilaiSiswa::where('id_siswa', Auth::user()->id_siswa)->where('semester_id', $siswa->semester_sekarang)->where('id_kelas', $siswa->id_kelas_sekarang)->get();

        // if ($request->filled(['pilihKelas', 'pilihSemester'])) {
        //     // Ambil data hanya jika kelas dan semester dipilih
        //     $mapel = RefMapel::with([
        //         'nilaiPengetahuan' => function ($query) use ($request) {
        //             $query->where('id_siswa', Auth::user()->id_siswa)
        //                 ->where('semester', $request->pilihSemester)
        //                 ->where('id_kelas', $request->pilihKelas);
        //         },
        //         'nilaiKeterampilan' => function ($query) use ($request) {
        //             $query->where('id_siswa', Auth::user()->id_siswa)
        //                 ->where('semester', $request->pilihSemester)
        //                 ->where('id_kelas', $request->pilihKelas);
        //         }
        //     ])->get();

        //     // Jika AJAX, kembalikan tabel saja
        // }

        // if ($request->ajax()) {
        //     if ($mapel->isEmpty()) {
        //         return response()->json(['message' => 'Data tidak ditemukan'], 404);
        //     }
        //     return view('siswa.nilai.table', compact('mapel'))->render();
        //     // return view('siswa.nilai.index', compact('mapel', 'siswa', 'kelas'));
        // }

        return view('siswa.nilai.index', compact('mapel', 'siswa', 'nilaiSiswa'));
    }

    public function report()
    {
        $kelas1 = RefKelas::whereIn('id', [1, 2, 3, 4])->get();
        $kelas2 = RefKelas::whereIn('id', [5, 6, 7, 8])->get();
        $kelas3 = RefKelas::whereIn('id', [9, 10, 11, 12])->get();

        $reportSiswa = ReportAkademikSiswa::with('kelas') // Pastikan relasi kelas sudah terdefinisi
            ->where('id_siswa', Auth::user()->id_siswa)
            ->first();

        $siswa = Siswa::where('id', Auth::user()->id_siswa)->first();

        $kelas1Report = $reportSiswa
            ? $reportSiswa->kelas()->whereIn('id', $kelas1->pluck('id'))->get()
            : collect([]);

        $kelas2Report = $reportSiswa
            ? $reportSiswa->kelas()->whereIn('id', $kelas2->pluck('id'))->get()
            : collect([]);

        $kelas3Report = $reportSiswa
            ? $reportSiswa->kelas()->whereIn('id', $kelas3->pluck('id'))->get()
            : collect([]);

        $data = [
            'kelas1' => $kelas1Report,
            'kelas2' => $kelas2Report,
            'kelas3' => $kelas3Report,
            'siswa' => $siswa,
            'reportSiswa' => $reportSiswa,
        ];

        // dd($reportSiswa->nama_siswa);

        return view('siswa.report.index', compact('data'));
    }

    public function download()
    {   
        $id = Auth::user()->id_siswa;
        $student = ReportAkademikSiswa::where('id_siswa', $id)->firstOrFail();
        $grades = is_array($student->nilai) ? $student->nilai : json_decode($student->nilai, true);

        return Excel::download(new ReportAkademikExport($student, $grades), 'LaporanNilaiSiswa.xlsx');
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
    public function store(StoreSiswaRequest $request)
    {
        //
    }

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
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        //
    }

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
