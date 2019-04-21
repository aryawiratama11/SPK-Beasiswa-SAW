<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteria;
use App\Range;

use Validator;
use Session;
use Illuminate\Support\Facades\Input;
use App\Alternatif;
use App\DetailCalon;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        $calon = new Alternatif();
        $alternatif = Alternatif::all();
        
        //dd(Range::getlist(1));
        return view('alternatifuser.index')->with('alternatif',$alternatif)->with('kriteria',$kriteria);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'nama'          => 'required',
            'jkel'       => 'required',
            'alamat'       => 'required',
            'idkriteria' => 'required',
            'nilai' => 'required',
            'alamat' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            Session::flash('message', "Pastikan masukkan anda!!!");
            Session::flash('type', "danger");
            return redirect()->back();
        } else {
            $nilai = $request->get('nilai');
            $idkriteria = $request->get('idkriteria');
            $key = end(array_keys($nilai));
            $alternatif = new Alternatif();
            $alternatif->nama = $request->get('nama');
            $alternatif->jkel = $request->get('jkel');
            $alternatif->alamat = $request->get('alamat');
            $alternatif->save();
            //die();
            for($i=0;$i<=$key;$i++){
                $detailcalon = new DetailCalon();
                $detailcalon->calonid = $alternatif->id;
                $detailcalon->nilai = $nilai[$i];
                $detailcalon->kriteriaid = $idkriteria[$i];
                $detailcalon->save();    
            }
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function admin(){
        $kriteria = Kriteria::all();
        $calon = new Alternatif();
        $alternatif = Alternatif::all();
        
        //dd(Range::getlist(1));
        return view('alternatifadmin.index')->with('alternatif',$alternatif)->with('kriteria',$kriteria);
    }
}
