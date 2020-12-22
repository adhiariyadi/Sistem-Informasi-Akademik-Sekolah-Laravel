<?php

namespace App\Http\Controllers;

use Auth;
use App\Siswa;
use App\Kelas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use PDF;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::OrderBy('nama_kelas', 'asc')->get();
        return view('admin.siswa.index', compact('kelas'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'no_induk' => 'required|string|unique:siswa',
            'nama_siswa' => 'required',
            'jk' => 'required',
            'kelas_id' => 'required'
        ]);

        if ($request->foto) {
            $foto = $request->foto;
            $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();
            Siswa::create([
                'no_induk' => $request->no_induk,
                'nis' => $request->nis,
                'nama_siswa' => $request->nama_siswa,
                'jk' => $request->jk,
                'kelas_id' => $request->kelas_id,
                'telp' => $request->telp,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'foto' => 'uploads/siswa/' . $new_foto
            ]);
            $foto->move('uploads/siswa/', $new_foto);
        } else {
            if ($request->jk == 'L') {
                $foto = 'uploads/siswa/52471919042020_male.jpg';
            } else {
                $foto = 'uploads/siswa/50271431012020_female.jpg';
            }
            Guru::create([
                'no_induk' => $request->no_induk,
                'nis' => $request->nis,
                'nama_siswa' => $request->nama_siswa,
                'jk' => $request->jk,
                'kelas_id' => $request->kelas_id,
                'telp' => $request->telp,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'foto' => $foto
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil menambahkan data siswa baru!');
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
        $siswa = Siswa::findorfail($id);
        return view('admin.siswa.details', compact('siswa'));
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
        $siswa = Siswa::findorfail($id);
        $kelas = Kelas::all();
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
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
        $this->validate($request, [
            'nama_siswa' => 'required',
            'jk' => 'required',
            'kelas_id' => 'required'
        ]);

        $siswa = Siswa::findorfail($id);
        $user = User::where('no_induk', $siswa->no_induk)->first();
        if ($user) {
            $user_data = [
                'name' => $request->nama_siswa
            ];
            $user->update($user_data);
        } else {
        }
        $siswa_data = [
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'jk' => $request->jk,
            'kelas_id' => $request->kelas_id,
            'telp' => $request->telp,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
        ];
        $siswa->update($siswa_data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findorfail($id);
        $countUser = User::where('no_induk', $siswa->no_induk)->count();
        if ($countUser >= 1) {
            $user = User::where('no_induk', $siswa->no_induk)->first();
            $siswa->delete();
            $user->delete();
            return redirect()->back()->with('warning', 'Data siswa berhasil dihapus! (Silahkan cek trash data siswa)');
        } else {
            $siswa->delete();
            return redirect()->back()->with('warning', 'Data siswa berhasil dihapus! (Silahkan cek trash data siswa)');
        }
    }

    public function trash()
    {
        $siswa = Siswa::onlyTrashed()->get();
        return view('admin.siswa.trash', compact('siswa'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::withTrashed()->findorfail($id);
        $countUser = User::withTrashed()->where('no_induk', $siswa->no_induk)->count();
        if ($countUser >= 1) {
            $user = User::withTrashed()->where('no_induk', $siswa->no_induk)->first();
            $siswa->restore();
            $user->restore();
            return redirect()->back()->with('info', 'Data siswa berhasil direstore! (Silahkan cek data siswa)');
        } else {
            $siswa->restore();
            return redirect()->back()->with('info', 'Data siswa berhasil direstore! (Silahkan cek data siswa)');
        }
    }

    public function kill($id)
    {
        $siswa = Siswa::withTrashed()->findorfail($id);
        $countUser = User::withTrashed()->where('no_induk', $siswa->no_induk)->count();
        if ($countUser >= 1) {
            $user = User::withTrashed()->where('no_induk', $siswa->no_induk)->first();
            $siswa->forceDelete();
            $user->forceDelete();
            return redirect()->back()->with('success', 'Data siswa berhasil dihapus secara permanent');
        } else {
            $siswa->forceDelete();
            return redirect()->back()->with('success', 'Data siswa berhasil dihapus secara permanent');
        }
    }

    public function ubah_foto($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::findorfail($id);
        return view('admin.siswa.ubah-foto', compact('siswa'));
    }

    public function update_foto(Request $request, $id)
    {
        $this->validate($request, [
            'foto' => 'required'
        ]);

        $siswa = Siswa::findorfail($id);
        $foto = $request->foto;
        $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();
        $siswa_data = [
            'foto' => 'uploads/siswa/' . $new_foto,
        ];
        $foto->move('uploads/siswa/', $new_foto);
        $siswa->update($siswa_data);

        return redirect()->route('siswa.index')->with('success', 'Berhasil merubah foto!');
    }

    public function view(Request $request)
    {
        $siswa = Siswa::OrderBy('nama_siswa', 'asc')->where('kelas_id', $request->id)->get();

        foreach ($siswa as $val) {
            $newForm[] = array(
                'kelas' => $val->kelas->nama_kelas,
                'no_induk' => $val->no_induk,
                'nama_siswa' => $val->nama_siswa,
                'jk' => $val->jk,
                'foto' => $val->foto
            );
        }

        return response()->json($newForm);
    }

    public function cetak_pdf(Request $request)
    {
        $siswa = siswa::OrderBy('nama_siswa', 'asc')->where('kelas_id', $request->id)->get();
        $kelas = Kelas::findorfail($request->id);

        $pdf = PDF::loadView('siswa-pdf', ['siswa' => $siswa, 'kelas' => $kelas]);
        return $pdf->stream();
        // return $pdf->stream('jadwal-pdf.pdf');
    }

    public function kelas($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::where('kelas_id', $id)->OrderBy('nama_siswa', 'asc')->get();
        $kelas = Kelas::findorfail($id);
        return view('admin.siswa.show', compact('siswa', 'kelas'));
    }

    public function export_excel()
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_siswa', $nama_file);
        Excel::import(new SiswaImport, public_path('/file_siswa/' . $nama_file));
        return redirect()->back()->with('success', 'Data Siswa Berhasil Diimport!');
    }

    public function deleteAll()
    {
        $siswa = Siswa::all();
        if ($siswa->count() >= 1) {
            Siswa::whereNotNull('id')->delete();
            Siswa::withTrashed()->whereNotNull('id')->forceDelete();
            return redirect()->back()->with('success', 'Data table siswa berhasil dihapus!');
        } else {
            return redirect()->back()->with('warning', 'Data table siswa kosong!');
        }
    }
}
