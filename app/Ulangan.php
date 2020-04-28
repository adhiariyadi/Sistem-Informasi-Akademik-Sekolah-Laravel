<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ulangan extends Model
{
    protected $fillable = ['siswa_id', 'kelas_id', 'guru_id', 'mapel_id', 'ulha_1', 'ulha_2', 'uts', 'ulha_3', 'uas'];

    protected $table = 'ulangan';
}
