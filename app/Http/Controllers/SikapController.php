<?php

namespace App\Http\Controllers;

use Auth;
use App\Mapel;
use App\Guru;
use App\Siswa;
use App\Kelas;
use App\Jadwal;
use App\Sikap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use DB;

class SikapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();
        if (
            $guru->mapel->nama_mapel == "Pendidikan Agama dan Budi Pekerti" ||
            $guru->mapel->nama_mapel == "Pendidikan Pancasila dan Kewarganegaraan"
        ) {
            $jadwal = Jadwal::where('guru_id', $guru->id)->orderBy('kelas_id')->get();
            $kelas = $jadwal->groupBy('kelas_id');
            return view('guru.sikap.index', compact('kelas', 'guru'));
        } else {
            return redirect()->back()->with('error', 'Maaf guru ini tidak dapat menambahkan nilai sikap!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('admin.sikap.home', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guru = Guru::findorfail($request->guru_id);
        $cekJadwal = Jadwal::where('guru_id', $guru->id)->where('kelas_id', $request->kelas_id)->count();
        if ($cekJadwal >= 1) {
            if (
                $guru->mapel->nama_mapel == "Pendidikan Agama dan Budi Pekerti" ||
                $guru->mapel->nama_mapel == "Pendidikan Pancasila dan Kewarganegaraan"
            ) {
                Sikap::updateOrCreate(
                    [
                        'id' => $request->id
                    ],
                    [
                        'siswa_id' => $request->siswa_id,
                        'kelas_id' => $request->kelas_id,
                        'guru_id' => $request->guru_id,
                        'mapel_id' => $guru->mapel_id,
                        'sikap_1' => $request->sikap_1,
                        'sikap_2' => $request->sikap_2,
                        'sikap_3' => $request->sikap_3
                    ]
                );
                return response()->json(['success' => 'Nilai sikap siswa berhasil ditambahkan!']);
            } else {
                return redirect()->json(['error' => 'Maaf guru ini tidak dapat menambahkan nilai sikap!']);
            }
        } else {
            return response()->json(['error' => 'Maaf guru ini tidak mengajar kelas ini!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();
        $kelas = Kelas::findorfail($id);
        $siswa = Siswa::where('kelas_id', $id)->get();
        return view('guru.sikap.show', compact('guru', 'kelas', 'siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $kelas = Kelas::findorfail($id);
        $siswa = Siswa::orderBy('nama_siswa')->where('kelas_id', $id)->get();
        return view('admin.sikap.index', compact('kelas', 'siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sikap($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::findorfail($id);
        $kelas = Kelas::findorfail($siswa->kelas_id);
        $mapel = Mapel::where('nama_mapel', 'Pendidikan Agama dan Budi Pekerti')->orWhere('nama_mapel', 'Pendidikan Pancasila dan Kewarganegaraan')->get();
        return view('admin.sikap.show', compact('mapel', 'siswa', 'kelas'));
    }

    public function siswa()
    {
        $siswa = Siswa::where('no_induk', Auth::user()->no_induk)->first();
        $kelas = Kelas::findorfail($siswa->kelas_id);
        $mapel = Mapel::where('nama_mapel', 'Pendidikan Agama dan Budi Pekerti')->orWhere('nama_mapel', 'Pendidikan Pancasila dan Kewarganegaraan')->get();
        return view('siswa.sikap', compact('siswa', 'kelas', 'mapel'));
    }
}
