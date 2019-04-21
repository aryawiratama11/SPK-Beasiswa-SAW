<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SPK;
use App\Alternatif;
use App\Kriteria;
use App\DetailCalon;
use PDF;

class PDFController extends Controller
{
    public function pdf(){
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();
        //dd(DetailCalon::detail(3));
        $spk = new SPK();
        $final = $spk->final();
        $winner = $spk->getWinner();

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf',compact('kriteria','alternatif','winner'));
        return $pdf->download('result.pdf');

    }
}
