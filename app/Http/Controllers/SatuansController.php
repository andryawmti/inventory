<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Satuan;
use DB;

class SatuansController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $satuans = Satuan::orderBy('id_satuan','desc')->get();
        $satuans = Satuan::all();
        return view('pages.master.satuan.satuan_index')->with('satuans', $satuans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.satuan.satuan_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $satuan = new Satuan;
        $satuan->nama_satuan = $request->input('nama_satuan');
        $satuan->save();
        return redirect('/satuan')->with('success', 'Data satuan berhasil disimpan');
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
        $satuan = Satuan::find($id);
        // return json_encode($satuan);
        return view('pages.master.satuan.satuan_edit')->with('satuan', $satuan);
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
        $satuan = Satuan::find($id);
        $satuan->nama_satuan = $request->input('nama_satuan');
        $satuan->save();
        return redirect('/satuan')->with('success', 'Data satuan berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $satuan = Satuan::find($id);
        $satuan->delete();
        return redirect('/satuan')->with('success', 'Data satuan berhasil dihapus');
    }
}
