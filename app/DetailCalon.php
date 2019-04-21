<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class DetailCalon extends Model
{
    protected $fillable = [
        'nilai', 'kriteriaid','calonid',
    ];

    protected $table = "detailcalon";

    public static function detail($id){
        $detail = DB::table('detailcalon')
            ->join('kriteria', 'kriteria.id', '=', 'detailcalon.kriteriaid')
            ->where('detailcalon.calonid', '=', $id)
            ->select('*','detailcalon.id as idcal')
            ->get();
        return $detail;
    }

}
