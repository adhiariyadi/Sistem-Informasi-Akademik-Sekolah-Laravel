<?php

namespace App\Http\Controllers;

use App\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::where('opsi', 'pengumuman')->first();
        return view('admin.pengumuman', compact('pengumuman'));
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'isi' => 'required',
        ]);

        Pengumuman::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'isi' => $request->isi,
            ]
        );

        return redirect()->back()->with('success', 'Pengumuman berhasil di perbarui!');
    }
}
