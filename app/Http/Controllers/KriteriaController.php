<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Session;
use Illuminate\Support\Facades\Input;
use App\Kriteria;


class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Auth::guard('admin')->user());
        $kriteria = Kriteria::all();
        return view('kriteriaadmin.index')->with('kriteria',$kriteria);
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
            'atribut'       => 'required',
            'bobot'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            Session::flash('message', "Pastikan masukkan anda!!!");
            Session::flash('type', "danger");
            return redirect()->back();
        } else {
            $kriteria = new Kriteria();
            $kriteria->nama = $request->get('nama');
            $kriteria->atribut = $request->get('atribut');
            $kriteria->bobot = $request->get('bobot');
            $kriteria->save();
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
            'nama'          => 'required',
            'atribut'       => 'required',
            'bobot'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            Session::flash('message', "Pastikan masukkan anda!!!");
            Session::flash('type', "danger");
            return redirect()->back();
        } else {
            $kriteria = Kriteria::find($id);
            $kriteria->nama = $request->get('nama');
            $kriteria->atribut = $request->get('atribut');
            $kriteria->bobot = $request->get('bobot');
            $kriteria->save();
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
        $kriteria = Kriteria::find($id);
        $kriteria->delete();
        return redirect()->back();
    }

    public function user(){
        $kriteria = Kriteria::all();
        return view('kriteriauser.index')->with('kriteria',$kriteria);
    }
}
