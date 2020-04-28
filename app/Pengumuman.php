<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $fillable = ['isi'];

    protected $table = 'pengumuman';
}
