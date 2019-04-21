<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Range;
use App\Kriteria;
use Validator;
use Session;
use Illuminate\Support\Facades\Input;

class RangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        $range1 = new Range();
        $range = $range1->joinKriteria();
        //dd($range);
        return view('rangeadmin.index')->with('range',$range)->with('kriteria',$kriteria);
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
            'keterangan'          => 'required',
            'nilai'       => 'required',
            'kriteriaid'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            Session::flash('message', "Pastikan masukkan anda!!!");
            Session::flash('type', "danger");
            return redirect()->back();
        } else {
            $range = new Range();
            $range->keterangan = $request->get('keterangan');
            $range->kriteriaid = $request->get('kriteriaid');
            $range->nilai = $request->get('nilai');
            $range->save();
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
        $rules = array(
            'kriteriaid'          => 'required',
            'nama'       => 'required',
            'nilai'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            Session::flash('message', "Pastikan masukkan anda!!!");
            Session::flash('type', "danger");
            return redirect()->back();
        } else {
            $range = Range::find($id);
            $range->keterangan = $request->get('nama');
            $range->kriteriaid = $request->get('kriteriaid');
            $range->nilai = $request->get('nilai');
            $range->save();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $range = Range::find($id);
        $range->delete();
        return redirect()->back();
    }

    public function user(){
        $kriteria = Kriteria::all();
        $range1 = new Range();
        $range = $range1->joinKriteria();
        //dd($range);
        return view('rangeuser.index')->with('range',$range)->with('kriteria',$kriteria);
    }
}
