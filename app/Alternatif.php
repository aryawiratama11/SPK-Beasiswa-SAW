<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB; 

class Alternatif extends Model
{
    protected $fillable = [
        'nama', 'atribut','bobot','alamat',
    ];

    protected $table = "calon";

    public function joinKriteria(){
        $joinkriteria = DB::table('calon')
            ->join('kriteria', 'kriteria.id', '=', 'calon.kriteriaid')
            ->select('*','calon.id as idcalon','kriteria.id as idkriteria','calon.nama as nama','kriteria.nama as namakriteria')
            ->get();

        return $joinkriteria;
    }

}
