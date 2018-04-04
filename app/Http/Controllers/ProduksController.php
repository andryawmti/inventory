<?php

namespace App\Http\Controllers;

use App\Satuan;
use Illuminate\Http\Request;
use App\Produk;
use DB;
use Excel;
use App\Stock;

class ProduksController extends Controller
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
        // $produks = Produk::all();
        $produks = DB::table('produks')
        ->join('satuans', 'produks.id_satuan', '=', 'satuans.id_satuan')
        ->select('produks.*', 'satuans.nama_satuan')
        ->get();

        // $produks = Produk::orderBy('produk_id', 'desc')->get();
        // $produks = Produk::where('id_produk', '1')->get();
        return view('pages.master.produk.produk_index')->with('produks', $produks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.produk.produk_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = new Produk;
        $produk->nama_produk = $request->input('nama_produk');
        $produk->id_satuan = $request->input('satuan');
        $produk->harga_beli = $request->input('harga_beli');
        $produk->harga_jual = $request->input('harga_jual');
        $produk->stok = $request->input('stok');
        $save = $produk->save();

        if ($save) {
            $stock = new Stock();
            $stock->stock = $request->input('stok');
            $stock->id_produk = $produk->id_produk;
            $stock->created_at = date('Y-m-d h:i:s');
            $stock->updated_at = date('Y-m-d h:i:s');
            $stock->save();
        }

        $message = array(
            'error' => '1',
            'message' => 'Produk berhasil ditambahkan'
        );

        return redirect('/produk/create')->with('success','Produk berhasil ditambahkan');
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
        $produk = DB::table('produks as p')
            ->leftJoin('satuans as s','s.id_satuan','=','p.id_satuan')
            ->select('p.*','s.nama_satuan')
            ->where('p.id_produk','=',$id)
            ->get();
        $satuans = Satuan::all();
        $params = array(
            'produk' => $produk[0],
            'satuans' => $satuans,
        );
        return view('pages.master.produk.produk_edit')->with('params', $params);
        // return json_encode($produk[0]);
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
        $produk = Produk::find($id);
        $produk->nama_produk = $request->input('nama_produk');
        $produk->id_satuan = $request->input('id_satuan');
        $produk->harga_beli = $request->input('harga_beli');
        $produk->harga_jual = $request->input('harga_jual');
        $produk->stok = $request->input('stok');
        $save = $produk->save();

//        $stock = Stock::where('id_produk', $produk->id_produk)->get();
//
//        if ($save && count($stock) < 1) {
//            $new_stock = new Stock();
//            $new_stock->stock = $request->input('stok');
//            $new_stock->id_produk = $produk->id_produk;
//            $new_stock->created_at = date('Y-m-d h:i:s');
//            $new_stock->updated_at = date('Y-m-d h:i:s');
//            $new_stock->save();
//        } else {
//            $stock->stock = $request->input('stok');
//            $stock->id_produk = $produk->id_produk;
//            $stock->created_at = date('Y-m-d h:i:s');
//            $stock->updated_at = date('Y-m-d h:i:s');
//            $stock->save();
//        }

        return redirect('/produk')->with('success', 'Data produk berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return redirect('/produk')->with('success', 'Produk berhasil dihapus');
    }

    public function getHargaProduk($id){
        $produk = DB::table('produks')
        ->join('satuans', 'produks.id_satuan', '=', 'satuans.id_satuan')
        ->select('produks.*','satuans.nama_satuan')->where('produks.id_produk', '=', $id)->get();
        return json_encode($produk[0]);
    }

    public function produkImport(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $produk = new Produk();
                    $produk->nama_produk = $value->nama_produk;
                    $produk->id_satuan = $value->id_satuan;
                    $produk->harga_beli = $value->harga_beli;
                    $produk->harga_jual = $value->harga_jual;
                    $produk->stok = $value->stok;
                    $produk->save();
                }
            }
        }

        return redirect('/produk')->with('success', 'Data produk berhasil diimport');
    }

}
