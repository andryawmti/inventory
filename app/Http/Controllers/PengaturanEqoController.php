<?php

namespace App\Http\Controllers;

use App\Distributor;
use Illuminate\Http\Request;
use App\PengaturanEqo;
Use App\Produk;
Use DB;

class PengaturanEqoController extends Controller
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
        $aturan_eqo = $this->getAllAturan();
        return view('pages.pengaturan_eqo.index')->with('aturan_eqo', $aturan_eqo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = $this->getProduks();
        $distributors = Distributor::all();
        return view('pages.pengaturan_eqo.create')->with(['produks'=>$produks, 'distributors'=>$distributors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $eqo = new PengaturanEqo;
        $eqo->id_produk = $request->input('id_produk');
        $eqo->id_distributor = $request->input('id_distributor');
        $eqo->annual_purchase =  $request->input('unit_per_year');
        $eqo->holding_cost = $request->input('holding_cost');
        $eqo->fixed_cost = $request->input('fixed_cost');
        $save = $eqo->save();
        $message = array(
            'success' => '1',
            'message' => 'Aturan EQO berhasil ditambahkan'
        );

        return redirect('/eqo/create')->with('success','Aturan Eqo berhasil ditambahkan');
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
        $aturan = PengaturanEqo::find($id);
        $produks = Produk::all();
        $produk = Produk::find($aturan->id_produk);
        $distributors = Distributor::all();
        return view('pages.pengaturan_eqo.edit')->with(['aturan' => $aturan, 'produk' => $produk, 'produks' => $produks,'distributors'=>$distributors]);
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
        $aturan = PengaturanEqo::find($id);
        $aturan->id_produk = $request->input('id_produk');
        $aturan->id_distributor = $request->input('id_distributor');
        $aturan->annual_purchase = $request->input('unit_per_year');
        $aturan->holding_cost = $request->input('holding_cost');
        $aturan->fixed_cost = $request->input('fixed_cost');
        $aturan->updated_at = date('Y-m-d h:i:s');
        $update = $aturan->save();
        return redirect('/eqo')->with('success', 'Data aturan EQO berhasil diperbaharui');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$aturan = PengaturanEqo::find($id);
        $delete = $aturan->delete();*/
        return redirect('/eqo')->with('success', 'Data Aturan EQO berhasil diperbaharui');
    }

    private function getAllAturan()
    {
        $aturans = DB::table('pengaturan_eqos')
        ->join('produks', 'produks.id_produk', '=', 'pengaturan_eqos.id_produk')
        ->select('pengaturan_eqos.*', 'produks.*')
        ->get();

        return $aturans;
    }

    private function getProduks()
    {
        $produks = DB::table('produks')
                ->leftJoin('pengaturan_eqos', 'produks.id_produk', '=', 'pengaturan_eqos.id_produk')
                ->select('produks.*')
                ->where('pengaturan_eqos.id_produk', '=', null)
                ->get();
        return $produks;
    }
}
