<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['guru_id', 'kkm', 'deskripsi_a', 'deskripsi_b', 'deskripsi_c', 'deskripsi_d'];

    public function guru()
    {
        return $this->belongsTo('App\Guru')->withDefault();
    }

    protected $table = 'nilai';
}
