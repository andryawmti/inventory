<?php

namespace App\Http\Controllers;

use App\DetailTransaksi;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaksi;
use App\PengaturanEqo;

class PembelianController extends Controller
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
        // $pembelians = Transaksi::all();
        $pembelians = DB::table('transaksis')
        ->join('distributors', 'transaksis.id_distributor', '=', 'distributors.id_distributor')
        ->select('transaksis.*', 'distributors.nama_distributor')
        ->where('transaksis.type', '=', '0')
        ->get();
        // return view('pages.pembelian.pembelian_index')->with('pembelians', $pembelians);
        return view('pages.pembelian.pembelian_index')->with('pembelians', $pembelians);
    }

    public function index_search(Request $request)
    {
        $ds = $request->input('date_start');
        $dl = $request->input('date_last');

        $sql = "SELECT *, d.nama_distributor FROM `transaksis` t JOIN `distributors` d ON t.id_distributor = d.id_distributor WHERE DATE_FORMAT(t.tgl_transaksi, '%Y-%m-%d') >= DATE_FORMAT('".$ds."', '%Y-%m-%d') AND DATE_FORMAT(t.tgl_transaksi, '%Y-%m-%d') <= DATE_FORMAT('".$dl."', '%Y-%m-%d')";

        $pembelians = DB::select($sql);
        return view('pages.pembelian.pembelian_index')->with('pembelians', $pembelians);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $distributors = DB::table('distributors')->get();
        $barangs = DB::table('produks')->get();
        $params = array(
            'distributors' => $distributors,
            'barangs' => $barangs
        );
        return view('pages.pembelian.pembelian_create')->with('params', $params);
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
        $transaksi->id_distributor = $request->input('id_distributor');
        $transaksi->tgl_transaksi = $request->input('tgl_transaksi');
        $transaksi->total_harga = $request->input('total');
        $transaksi->type = '0';

        $result = array();

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
//                    $this->updateStok(array('id'=>$p['id_produk'],'new_stok'=>$p['qty']));
                }
                $result = array(
                    'error' => 0,
                    'message' => 'Berhasil menyimpan transaksi pembelian'
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
        $pembelian = DB::table('transaksis')
        ->join('distributors', 'transaksis.id_distributor', '=', 'distributors.id_distributor')
        ->select('transaksis.*', 'distributors.nama_distributor')
        ->where('transaksis.type', '=', '0')
        ->where('transaksis.id_transaksi', '=', $id)
        ->get();

        $detail_pembelian = DB::table('detail_transaksi')
        ->leftJoin('produks', 'detail_transaksi.id_produk', '=', 'produks.id_produk')
        ->select('detail_transaksi.*', 'produks.*')
        ->where('detail_transaksi.id_transaksi', '=', $id)
        ->get();

        return array(
            'pembelian'        => $pembelian,
            'detail_pembelian' => $detail_pembelian
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
        $distributors = DB::table('distributors')->get();
        $barangs = DB::table('produks')->get();
        $pembelian = DB::table('transaksis')
            ->join('distributors', 'transaksis.id_distributor', '=', 'distributors.id_distributor')
            ->select('transaksis.*', 'distributors.nama_distributor')
            ->where('transaksis.type', '=', '0')
            ->where('transaksis.id_transaksi', '=', $id)
            ->get();

        $detail_pembelian = DB::table('detail_transaksi as d')
            ->leftJoin('produks as p', 'd.id_produk', '=', 'p.id_produk')
            ->leftJoin('satuans as s', 'p.id_satuan', '=', 's.id_satuan')
            ->select('d.*', 'p.*', 's.nama_satuan')
            ->where('d.id_transaksi', '=', $id)
            ->get();
        $params = array(
            'distributors' => $distributors,
            'barangs' => $barangs,
            'pembelian' => $pembelian,
            'detail_pembelian' => $detail_pembelian,
        );
        return view('pages.pembelian.pembelian_edit', compact('params', $params));
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
        $transaksi->id_distributor = $request->input('id_distributor');
        $transaksi->tgl_transaksi = $request->input('tgl_transaksi');
        $transaksi->total_harga = $request->input('total');
        $transaksi->type = '0';

        $result = array();
        if($transaksi->save()){
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
                    'message' => 'Berhasil memperbaharui transaksi pembelian'
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

    public function autoPurchase()
    {
        $list_eqo = DB::table('pengaturan_eqos as e')
            ->leftJoin('produks as p','e.produk_id','=','p.id_produk')
            ->select('e.*','p.*')
            ->orderBy('e.created_at','desc')
            ->get();

        $eqo_result = array();

        foreach ($list_eqo as $e) {
            $p = $e->harga_beli;
            $d = $e->annual_purchase;
            $h = $e->holding_cost;
            $s = $e->fixed_cost;
            $q = 2 * $s * $d / $h;
            $q = round(sqrt($q),4);
            $e->quantity_per_order = round($q);
            $e->number_of_order = round($d / $q,1);
            $e->total_cost = round($p * $d + $h * $q / 2 + $s * $d / $q);
            $eqo_result[] = $e;

        }
//        return json_encode($eqo_result);
        return view('pages.pembelian.pembelian_jadwal')->with('eqo_result', $eqo_result);
    }

    public function makePurchase()
    {
        $produks = $this->getOutOfStockProduk();
        if (count($produks) > 0) {
            $transaksi = new Transaksi;
            $transaksi->id_distributor = '11';
            $transaksi->tgl_transaksi = date('Y-m-d h:i:s');
            $transaksi->total_harga = $this->getTotalHarga($produks);
            $transaksi->type = '0';
            $transaksi->mode = '1';
            if($transaksi->save()){
                $my_produks = array();
                $id_transaksi = $transaksi->id_transaksi;
                foreach ($produks as $produk) {
                    $my_produks[] = array(
                        'id_transaksi' => $id_transaksi,
                        'id_produk' => $produk->id_produk,
                        'qty' => $produk->quantity_per_order,
                        'harga' => $produk->harga_beli,
                        'created_at'=> date("Y-m-d h:i:s"),
                        'updated_at'=> date("Y-m-d h:i:s")
                    );
                }
                $isProduksInserted = DB::table('detail_transaksi')->insert($my_produks);
                if($isProduksInserted){
                    foreach ($my_produks as $p) {
//                        $this->updateStok(array('id'=>$p['id_produk'],'new_stok'=>$p['qty']));
                        $eqo_rule = PengaturanEqo::where('produk_id','=',$p['id_produk'])->get()[0];
                        $eqo_rule->current_number_of_order = $eqo_rule->current_number_of_order + 1;
                        $eqo_rule->save();
                    }
                    $result = array(
                        'error' => 0,
                        'message' => 'Berhasil menyimpan transaksi pembelian'
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
        }
        return json_encode(array(
            'error' => '0',
            'message' => 'Produk tidak ditemukan'
        ));
    }

    public function getOutOfStockProduk()
    {
        $produks = DB::table('pengaturan_eqos as e')
            ->leftJoin('produks as p','p.id_produk','=','e.produk_id')
            ->select('e.*','p.*')
            ->where('p.stok','<=','5')
            ->get();

        $eqo_result = $this->hitungEqo($produks);
        $eqo = array();
        foreach($eqo_result as $eq) {
            if ($eq->current_number_of_order < $eq->number_of_order) {
                $eqo[] = $eq;
            }
        }
        return $eqo;
    }

    public function getTotalHarga($produks)
    {   $total = 0;
        foreach ($produks as $p) {
            $total += $p->quantity_per_order * $p->harga_beli;
        }
        return $total;
    }

    public function hitungEqo($produks)
    {
        $eqo_result = array();
        foreach ($produks as $e) {
            $p = $e->harga_beli;
            $d = $e->annual_purchase;
            $h = $e->holding_cost;
            $s = $e->fixed_cost;
            $q = 2 * $s * $d / $h;
            $q = round(sqrt($q),4);
            $e->quantity_per_order = round($q);
            $e->number_of_order = round($d / $q,1);
            $e->total_cost = round($p * $d + $h * $q / 2 + $s * $d / $q);
            $eqo_result[] = $e;
        }

        return $eqo_result;

    }

    private function updateStok($params)
    {
        $produk = Produk::find($params['id']);
        $produk->stok += $params['new_stok'];
        return $produk->save();
    }

    public function barangDiterima($id)
    {
        $transaksi = Transaksi::find($id);
        if ($transaksi->is_delivered == 0) {
            $produks = DB::table('detail_transaksi as d')
                ->leftJoin('produks as p', 'd.id_produk', '=', 'p.id_produk')
                ->leftJoin('satuans as s', 'p.id_satuan', '=', 's.id_satuan')
                ->select('d.*', 'p.*', 's.nama_satuan')
                ->where('d.id_transaksi', '=', $id)
                ->get();

            foreach ($produks as $p) {
                $this->updateStok(array('id'=>$p->id_produk,'new_stok'=>$p->qty));
            }
        }

        $transaksi->is_delivered = '1';
        $transaksi->save();
        return redirect(url('pembelian'))->with('success', 'Stok produk berhasil diperbaharui');
    }

}
