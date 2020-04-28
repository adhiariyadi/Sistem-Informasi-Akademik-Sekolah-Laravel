<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $fillable = ['ket', 'color'];

    protected $table = 'kehadiran';
}
