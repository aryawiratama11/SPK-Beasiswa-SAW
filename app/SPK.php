<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kriteria;
use App\Range;
use App\Alternatif;
use App\DetailCalon;
use DB;

class SPK extends Model
{

    public function minormax($id){
        $detail = DB::table('kriteria')
            ->where('id', '=', $id)
            ->first();
        if($detail->atribut == 'Benefit'){
            $max = DB::table('detailcalon')
                ->where('kriteriaid',$id)
                ->max('nilai');
            return $max;
        } else {
            $min = DB::table('detailcalon')
                ->where('kriteriaid',$id)
                ->min('nilai');
            return $min;
        }
        
    }

    public function calculate($id){
        $arr_result = array();
        $finalresult = 0;
        $deatils = DetailCalon::detail($id);
            foreach ($deatils as $detail){
                if($detail->atribut == "Benefit"){

                    $result_normalisasi = $detail->nilai/SPK::minormax($detail->kriteriaid);
                    $finalresult = $finalresult + ($result_normalisasi*$detail->bobot);
                }else{
                    $result_normalisasi = SPK::minormax($detail->kriteriaid)/$detail->nilai;
                    $finalresult = $finalresult + ($result_normalisasi*$detail->bobot);
                }


            }
            $arr_final = array($id,$finalresult);   

            //$this->arr_final = $finalresult;
        return $finalresult;
    }

    public function final(){
        $count = DB::table('tempwinner')->count();
        if($count > 0){ 
            DB::table('tempwinner')->delete();

            $alternatif = Alternatif::all();
            $kriteria = Kriteria::all();
            //dd($alternatif);
            foreach($alternatif as $detailalternatif){    
                $new = $this->calculate($detailalternatif->id);
                DB::table('tempwinner')->insert(
                    ['calonid' => $detailalternatif->id, 'nilai' => $new]
                );
            }
        } else {
            $alternatif = Alternatif::all();
            $kriteria = Kriteria::all();
            //dd($alternatif);
            foreach($alternatif as $detailalternatif){    
                $new = $this->calculate($detailalternatif->id);
                DB::table('tempwinner')->insert(
                    ['calonid' => $detailalternatif->id, 'nilai' => $new]
                );
            }
        }

        
        
    }


    public function getWinner(){
        $tempwinner = DB::table('tempwinner')
            ->join('calon', 'calon.id', '=', 'tempwinner.calonid')
            ->orderBy('tempwinner.nilai', 'desc')
            ->get();
        return $tempwinner;
    }


    public function topgetWinner(){
        $tempwinner = DB::table('tempwinner')
            ->join('calon', 'calon.id', '=', 'tempwinner.calonid')
            ->orderBy('tempwinner.nilai', 'desc')
            ->limit(5)
            ->get();
        return $tempwinner;
    }

    public function showwinner(&$ar){
        //dd($ar);
    }
}
