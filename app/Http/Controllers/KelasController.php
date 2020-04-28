<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Guru;
use App\Paket;
use App\Jadwal;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::OrderBy('nama_kelas', 'asc')->get();
        $guru = Guru::OrderBy('nama_guru', 'asc')->get();
        $paket = Paket::all();
        return view('admin.kelas.index', compact('kelas', 'guru', 'paket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guru = Guru::OrderBy('nama_guru', 'asc')->get();
        return view('admin.kelas.create', compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id != '') {
            $this->validate($request, [
                'nama_kelas' => 'required|min:6|max:10',
                'paket_id' => 'required',
                'guru_id' => 'required|unique:kelas',
            ]);
        } else {
            $this->validate($request, [
                'nama_kelas' => 'required|unique:kelas|min:6|max:10',
                'paket_id' => 'required',
                'guru_id' => 'required|unique:kelas',
            ]);
        }

        Kelas::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'nama_kelas' => $request->nama_kelas,
                'paket_id' => $request->paket_id,
                'guru_id' => $request->guru_id,
            ]
        );

        return redirect()->back()->with('success', 'Data kelas berhasil diperbarui!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
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
        $kelas = Kelas::findorfail($id);
        $countJadwal = Jadwal::where('kelas_id', $kelas->id)->count();
        if ($countJadwal >= 1) {
            Jadwal::where('kelas_id', $kelas->id)->delete();
        } else {
        }
        $countSiswa = Siswa::where('kelas_id', $kelas->id)->count();
        if ($countSiswa >= 1) {
            Siswa::where('kelas_id', $kelas->id)->delete();
        } else {
        }
        $kelas->delete();
        return redirect()->back()->with('warning', 'Data kelas berhasil dihapus! (Silahkan cek trash data kelas)');
    }

    public function trash()
    {
        $kelas = Kelas::onlyTrashed()->get();
        return view('admin.kelas.trash', compact('kelas'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $kelas = Kelas::withTrashed()->findorfail($id);
        $countJadwal = Jadwal::withTrashed()->where('kelas_id', $kelas->id)->count();
        if ($countJadwal >= 1) {
            Jadwal::withTrashed()->where('kelas_id', $kelas->id)->restore();
        } else {
        }
        $countSiswa = Siswa::withTrashed()->where('kelas_id', $kelas->id)->count();
        if ($countSiswa >= 1) {
            Siswa::withTrashed()->where('kelas_id', $kelas->id)->restore();
        } else {
        }
        $kelas->restore();
        return redirect()->back()->with('info', 'Data kelas berhasil direstore! (Silahkan cek data kelas)');
    }

    public function kill($id)
    {
        $kelas = Kelas::withTrashed()->findorfail($id);
        $countJadwal = Jadwal::withTrashed()->where('kelas_id', $kelas->id)->count();
        if ($countJadwal >= 1) {
            Jadwal::withTrashed()->where('kelas_id', $kelas->id)->forceDelete();
        } else {
        }
        $countSiswa = Siswa::withTrashed()->where('kelas_id', $kelas->id)->count();
        if ($countSiswa >= 1) {
            Siswa::withTrashed()->where('kelas_id', $kelas->id)->forceDelete();
        } else {
        }
        $kelas->forceDelete();
        return redirect()->back()->with('success', 'Data kelas berhasil dihapus secara permanent');
    }

    public function getEdit(Request $request)
    {
        $kelas = Kelas::where('id', $request->id)->get();
        foreach ($kelas as $val) {
            $newForm[] = array(
                'id' => $val->id,
                'nama' => $val->nama_kelas,
                'paket_id' => $val->paket_id,
                'guru_id' => $val->guru_id,
            );
        }
        return response()->json($newForm);
    }
}
