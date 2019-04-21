<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = [
        'nama', 'atribut','bobot',
    ];

    protected $table = "kriteria";

    //protected $primaryKey = 'kode';

    //public $incrementing = false;
}
