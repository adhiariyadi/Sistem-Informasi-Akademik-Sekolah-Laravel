<?php

namespace App\Exports;

use App\Guru;
use Maatwebsite\Excel\Concerns\FromCollection;

class GuruExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $guru = Guru::join('mapel', 'mapel.id', '=', 'guru.mapel_id')->select('guru.nama_guru', 'guru.nip', 'guru.jk', 'mapel.nama_mapel')->get();
        return $guru;
    }
}
