<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;
use Excel;

class PelanggansController extends Controller
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
        $pelanggans = Pelanggan::all();
        return view('pages.master.pelanggan.pelanggan_index')->with('pelanggans', $pelanggans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.pelanggan.pelanggan_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pelanggan = new Pelanggan;
        $pelanggan->nama_pelanggan = $request->input('nama_pelanggan');
        $pelanggan->alamat = $request->input('alamat');
        $pelanggan->kota = $request->input('kota');
        $pelanggan->no_telepon = $request->input('no_telepon');
        $pelanggan->email = $request->input('email');
        $pelanggan->save();
        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil disimpan');
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
        $pelanggan = Pelanggan::find($id);
        return view('pages.master.pelanggan.pelanggan_edit')->with('pelanggan', $pelanggan);
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
        $pelanggan = Pelanggan::find($id);
        $pelanggan->nama_pelanggan = $request->input('nama_pelanggan');
        $pelanggan->alamat = $request->input('alamat');
        $pelanggan->kota = $request->input('kota');
        $pelanggan->no_telepon = $request->input('no_telepon');
        $pelanggan->email = $request->input('email');
        $pelanggan->save();
        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$pelanggan = Pelanggan::find($id);
        $pelanggan->delete();*/
        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil dihapus');
    }

    /**
     * Import data distributor dari excel
     * author: Hari Setiawan
     */
    public function pelangganImport(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $pelanggan = new Pelanggan;
                    $pelanggan->nama_pelanggan = $value->nama_pelanggan;
                    $pelanggan->alamat = $value->alamat;
                    $pelanggan->kota = $value->kota;
                    $pelanggan->no_telepon = $value->no_telepon;
                    $pelanggan->email = $value->email;
                    $pelanggan->save();
                }
            }
        }

        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil diimport');
    }
}
