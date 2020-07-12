<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $fillable = ['opsi', 'isi'];

    protected $table = 'pengumuman';
}
