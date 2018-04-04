<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MainController extends Controller
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
        $pembelian_stat = DB::table("transaksis as t")
            ->select(DB::raw("count(t.id_transaksi) as num, date_format(t.created_at, '%m') as month"))
            ->where("t.type", "=", "0")
            ->groupBy("month")
            ->get();
        $penjualan_stat = DB::table("transaksis as t")
            ->select(DB::raw("count(t.id_transaksi) as num, date_format(t.created_at, '%m') as month"))
            ->where("t.type", "=", "1")
            ->groupBy("month")
            ->get();
        $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $data_pembelian = array();
        $label_pembelian = array();
        foreach ($pembelian_stat as $p) {
            $data_pembelian[] = $p->num;
            $label_pembelian[] = $month[( (int)$p->month - 1)];
        }
        $data_penjualan = array();
        $label_penjualan = array();
        foreach ($penjualan_stat as $p) {
            $data_penjualan[] = $p->num;
            $label_penjualan[] = $month[( (int)$p->month - 1)];
        }

        $penjualans = DB::table('transaksis')
            ->join('pelanggans', 'transaksis.id_pelanggan', '=', 'pelanggans.id_pelanggan')
            ->select('transaksis.*', 'pelanggans.nama_pelanggan')
            ->where('transaksis.type', '=', '1')
            ->get();

        $pembelians = DB::table('transaksis')
            ->join('distributors', 'transaksis.id_distributor', '=', 'distributors.id_distributor')
            ->select('transaksis.*', 'distributors.nama_distributor')
            ->where('transaksis.type', '=', '0')
            ->get();

        $user_count = DB::table('users')->count();
        $produk_count = DB::table('produks')->count();
        $pelanggan_count = DB::table('pelanggans')->count();
        $distributor_count = DB::table('distributors')->count();
        $count = array(
            'user' => $user_count,
            'produk' => $produk_count,
            'pelanggan' => $pelanggan_count,
            'distributor' => $distributor_count,
        );

        $statistik = array(
            'pembelian' => array(
                'data' => $data_pembelian,
                'label' => $label_pembelian,
                'list_data' => $pembelians,
            ),
            'penjualan' => array(
                'data' => $data_penjualan,
                'label' => $label_penjualan,
                'list_data' => $penjualans,
            ),
        );
        return view('pages.dashboard')->with(array(
            'statistik' => $statistik,
            'count' => $count,
        ));
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
        //
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
        //
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
}
