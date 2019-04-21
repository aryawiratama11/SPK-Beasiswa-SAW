<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Range extends Model
{
    protected $fillable = [
        'keterangan', 'nilai','kriteriaid',
    ];

    protected $table = "range";

    public function joinKriteria(){
        $joinkriteria = DB::table('range')
            ->join('kriteria', 'kriteria.id', '=', 'range.kriteriaid')
            ->select('*','range.id as idrange','kriteria.id as idkriteria')
            ->get();

        return $joinkriteria;
    }


    public static function getlist($id){
        $getlist = DB::table('range')
            ->where('kriteriaid',$id)
            ->get();

        return $getlist;
    }


}
