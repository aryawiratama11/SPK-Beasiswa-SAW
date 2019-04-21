<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SPK;
use DB;
use Detail;
use App\Alternatif;

class TestController extends Controller
{
    public function testkriteria(){
        $spk = new SPK();
        echo $spk->minormax(3);
        $max = DB::table('detailcalon')
                ->where('kriteriaid',3)
                ->max('nilai');
        echo $max;
        dd(Detail::detail(5));
        //dd()
        echo $spk->final();
    }
}
