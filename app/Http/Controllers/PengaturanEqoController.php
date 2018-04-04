<?php

namespace App\Http\Controllers;

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
        return view('pages.pengaturan_eqo.create', compact('produks', $produks));
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
        $eqo->produk_id = $request->input('produk_id');
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
        $produk = Produk::find($aturan->produk_id);
        return view('pages.pengaturan_eqo.edit')->with(['aturan' => $aturan, 'produk' => $produk, 'produks' => $produks]);
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
        $aturan->produk_id = $request->input('produk_id');
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
        $aturan = PengaturanEqo::find($id);
        $delete = $aturan->delete();
        return redirect('/eqo')->with('success', 'Data Aturan EQO berhasil diperbaharui');
    }

    private function getAllAturan()
    {
        $aturans = DB::table('pengaturan_eqos')
        ->join('produks', 'produks.id_produk', '=', 'pengaturan_eqos.produk_id')
        ->select('pengaturan_eqos.*', 'produks.*')
        ->get();

        return $aturans;
    }

    private function getProduks()
    {
        $produks = DB::table('produks')
                ->leftJoin('pengaturan_eqos', 'produks.id_produk', '=', 'pengaturan_eqos.produk_id')
                ->select('produks.*')
                ->where('pengaturan_eqos.produk_id', '=', null)
                ->get();
        return $produks;
    }
}
