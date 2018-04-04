<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaksi;
use App\Produk;

class PenjualanController extends Controller
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
        $penjualans = DB::table('transaksis')
        ->join('pelanggans', 'transaksis.id_pelanggan', '=', 'pelanggans.id_pelanggan')
        ->select('transaksis.*', 'pelanggans.nama_pelanggan')
        ->where('transaksis.type', '=', '1')
        ->get();
        // return view('pages.pembelian.pembelian_index')->with('pembelians', $pembelians);
        return view('pages.penjualan.penjualan_index')->with('penjualans', $penjualans);
    }

    public function index_search(Request $request)
    {
        $ds = $request->input('date_start');
        $dl = $request->input('date_last');

        $sql = "SELECT *, p.nama_pelanggan FROM `transaksis` t JOIN `pelanggans` p ON t.id_pelanggan = p.id_pelanggan WHERE DATE_FORMAT(t.tgl_transaksi, '%Y-%m-%d') >= DATE_FORMAT('".$ds."', '%Y-%m-%d') AND DATE_FORMAT(t.tgl_transaksi, '%Y-%m-%d') <= DATE_FORMAT('".$dl."', '%Y-%m-%d')";

        $penjualans = DB::select($sql);
        return view('pages.penjualan.penjualan_index')->with('penjualans', $penjualans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggans = DB::table('pelanggans')->get();
        $produks = DB::table('produks')
            ->where('stok','>', '0')
            ->get();
        $params = array(
            'pelanggans' => $pelanggans,
            'produks' => $produks
        );
        return view('pages.penjualan.penjualan_create')->with('params', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produks = $request->input('produks');
        $transaksi = new Transaksi;
        $transaksi->id_pelanggan= $request->input('id_pelanggan');
        $transaksi->tgl_transaksi = $request->input('tgl_transaksi');
        $transaksi->total_harga = $request->input('total');
        $transaksi->biaya_kirim =  $request->input('biaya_kirim');
        $transaksi->grand_total = (int)$transaksi->biaya_kirim + (int)$transaksi->total_harga;
        $transaksi->type = '1';
        if($transaksi->save()){
            $id_transaksi = $transaksi->id_transaksi;
            foreach ($produks as $produk) {
                $my_produks[] = array(
                    'id_transaksi' => $id_transaksi,
                    'id_produk' => $produk['id_produk'],
                    'qty' => $produk['qty'],
                    'harga' => $produk['harga'],
                    'created_at'=> date("Y-m-d h:i:s"),
                    'updated_at'=> date("Y-m-d h:i:s")
                );
            }
            $isProduksInserted = DB::table('detail_transaksi')->insert($my_produks);
            if($isProduksInserted){
                foreach ($my_produks as $p) {
                    $this->updateStok(array('id'=>$p['id_produk'],'sold_stok'=>$p['qty']));
                }
                $result = array(
                    'error' => 0,
                    'message' => 'Berhasil menyimpan transaksi penjualan'
                );
            }else{
                $result = array(
                    'error' => 1,
                    'message' => 'Terjadi kesalahan, gagal menyimpan'
                );
            }
        }else{
            $result = array(
                'error' => 1,
                'message' => 'Terjadi kesalahan, gagal menyimpan'
            );
        }

        return json_encode($result);

        // return json_encode($my_produks);
        //return json_encode($produks);
        // return redirect('pembelian/create')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penjualan = DB::table('transaksis')
        ->join('pelanggans', 'transaksis.id_pelanggan', '=', 'pelanggans.id_pelanggan')
        ->select('transaksis.*', 'pelanggans.nama_pelanggan')
        ->where('transaksis.type', '=', '1')
        ->where('transaksis.id_transaksi', '=', $id)
        ->get();

        $detail_penjualan = DB::table('detail_transaksi')
        ->leftJoin('produks', 'detail_transaksi.id_produk', '=', 'produks.id_produk')
        ->select('detail_transaksi.*', 'produks.*')
        ->where('detail_transaksi.id_transaksi', '=', $id)
        ->get();

        return array(
            'penjualan'        => $penjualan,
            'detail_penjualan' => $detail_penjualan
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggans = DB::table('pelanggans')->get();
        $produks = DB::table('produks')->get();
        $penjualan = DB::table('transaksis as t')
            ->join('pelanggans as p', 't.id_pelanggan', '=', 'p.id_pelanggan')
            ->select('t.*', 'p.nama_pelanggan')
            ->where('t.type', '=', '1')
            ->where('t.id_transaksi', '=', $id)
            ->get();

        $detail_penjualan = DB::table('detail_transaksi as d')
            ->leftJoin('produks as p', 'd.id_produk', '=', 'p.id_produk')
            ->leftJoin('satuans as s', 'p.id_satuan', '=', 's.id_satuan')
            ->select('d.*', 'p.*', 's.nama_satuan')
            ->where('d.id_transaksi', '=', $id)
            ->get();
        $params = array(
            'pelanggans' => $pelanggans,
            'produks' => $produks,
            'penjualan' => $penjualan,
            'detail_penjualan' => $detail_penjualan,
        );
        return view('pages.penjualan.penjualan_edit', compact('params', $params));
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
        $produks = $request->input('produks');
        $transaksi = Transaksi::find($id);
        $transaksi->id_pelanggan= $request->input('id_pelanggan');
        $transaksi->tgl_transaksi = $request->input('tgl_transaksi');
        $transaksi->total_harga = $request->input('total');
        $transaksi->biaya_kirim =  $request->input('biaya_kirim');
        $transaksi->grand_total = (int)$transaksi->biaya_kirim + (int)$transaksi->total_harga;
        $transaksi->type = '1';
        $result = array();
        $update = $transaksi->save();
        if($update){
            $delete = DB::table('detail_transaksi')->where('id_transaksi', '=', $id)->delete();
            foreach ($produks as $produk) {
                $my_produks[] = array(
                    'id_transaksi' => $id,
                    'id_produk' => $produk['id_produk'],
                    'qty' => $produk['qty'],
                    'harga' => $produk['harga'],
                    'created_at'=> date("Y-m-d h:i:s"),
                    'updated_at'=> date("Y-m-d h:i:s")
                );
            }
            $isProduksInserted = DB::table('detail_transaksi')->insert($my_produks);
            if($isProduksInserted){
                $result = array(
                    'error' => 0,
                    'message' => 'Berhasil memperbaharui transaksi penjualan'
                );
            }else{
                $result = array(
                    'error' => 1,
                    'message' => 'Terjadi kesalahan dalam memperbaharui, gagal menyimpan'
                );
            }
        }else{
            $result = array(
                'error' => 1,
                'message' => 'Terjadi kesalahan dalam memperbaharui, gagal menyimpan'
            );
        }

        return json_encode($result);
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

    private function updateStok($params)
    {
        $produk = Produk::find($params['id']);
        $produk->stok -= $params['sold_stok'];
        return $produk->save();
    }

    public function barangDikirim($id)
    {
        $transaksi = Transaksi::find($id);
//        if ($transaksi->is_delivered == 0) {
//            $produks = DB::table('detail_transaksi as d')
//                ->leftJoin('produks as p', 'd.id_produk', '=', 'p.id_produk')
//                ->leftJoin('satuans as s', 'p.id_satuan', '=', 's.id_satuan')
//                ->select('d.*', 'p.*', 's.nama_satuan')
//                ->where('d.id_transaksi', '=', $id)
//                ->get();
//
//            foreach ($produks as $p) {
//                $this->updateStok(array('id'=>$p->id_produk,'sold_stok'=>$p->qty));
//            }
//        }
        $transaksi->is_delivered = '1';
        $transaksi->save();
        return redirect(url('penjualan'))->with('success', 'Stok produk berhasil diperbaharui');
    }

    public function cekKetersediaanProduk(Request $request)
    {
        $qty = $request->input('qty');
        $id = $request->input('id');
        $produk = Produk::find($id);
        if (($produk->stok - $qty) >= 0) {
            return json_encode(
                array(
                    'result' => 1,
                    'stok' => $produk->stok,
                )
            );
        }else{
            return json_encode(
                array(
                    'result' => 0,
                    'stok' => $produk->stok,
                )
            );
        }
    }
}
