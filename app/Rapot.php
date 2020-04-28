<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapot extends Model
{
    protected $fillable = ['siswa_id', 'kelas_id', 'guru_id', 'mapel_id', 'p_nilai', 'p_predikat', 'p_deskripsi', 'k_nilai', 'k_predikat', 'k_deskripsi'];

    protected $table = 'rapot';
}
