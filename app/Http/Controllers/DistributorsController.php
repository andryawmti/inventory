<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Distributor;
use Excel;


class DistributorsController extends Controller
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
        $distributors = Distributor::all();
        // return json_encode($distributors);
        return view('pages.master.distributor.distributor_index')->with('distributors', $distributors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.distributor.distributor_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $distributor = new Distributor;
        $distributor->nama_distributor = $request->input('nama_distributor');
        $distributor->alamat = $request->input('alamat');
        $distributor->kota = $request->input('kota');
        $distributor->no_telepon = $request->input('no_telepon');
        $distributor->email = $request->input('email');
        $distributor->save();
        return redirect('/distributor')->with('success', 'Data distributor berhasil ditambahkan');
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
        $distributor = Distributor::find($id);
        return view('pages.master.distributor.distributor_edit')->with('distributor', $distributor);
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
        $distributor = Distributor::find($id);
        $distributor->nama_distributor = $request->input('nama_distributor');
        $distributor->alamat = $request->input('alamat');
        $distributor->kota = $request->input('kota');
        $distributor->no_telepon = $request->input('no_telepon');
        $distributor->email = $request->input('email');
        $distributor->save();
        return redirect('/distributor')->with('success', 'Data distributor berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$distributor = Distributor::find($id);
        $distributor->delete();*/
        return redirect('/distributor')->with('success', 'Data distributor berhasil dihapus');
    }

    /**
     * Import data distributor dari excel
     * author: Hari Setiawan
     */
    public function distributorImport(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
//            return json_encode($data);exit;
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $distributor = new Distributor;
                    $distributor->nama_distributor = $value->nama_distributor;
                    $distributor->alamat = $value->alamat;
                    $distributor->kota = $value->kota;
                    $distributor->no_telepon = $value->no_telepon;
                    $distributor->email = $value->email;
                    $distributor->save();
                }
            }
        }

        return redirect('/distributor')->with('success', 'Data Distributor berhasil diimport');
    }
}
