<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SPK;
use App\Alternatif;
use App\Kriteria;
use App\DetailCalon;

class ResultController extends Controller
{
    public function index(){
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();
        //dd(DetailCalon::detail(3));
        $spk = new SPK();
        $final = $spk->final();
        $getwinner = $spk->getWinner();
        $fivegetwinner = $spk->topgetWinner();
        
        return view('resultadmin.index')->with('kriteria',$kriteria)->with('alternatif',$alternatif)->with('winner',$getwinner)->with('fivetop',$fivegetwinner);
    }

    public function user(){
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();
        $spk = new SPK();
        $final = $spk->final();
        $getwinner = $spk->getWinner();
        $fivegetwinner = $spk->topgetWinner();
        //dd(DetailCalon::detail(3));
        
        return view('resultuser.index')->with('kriteria',$kriteria)->with('alternatif',$alternatif)->with('winner',$getwinner)->with('fivetop',$fivegetwinner);
    }
}
