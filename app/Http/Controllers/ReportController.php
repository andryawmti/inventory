<?php

namespace App\Http\Controllers;

use App\DetailTransaksi;
use PDF;
use Illuminate\Http\Request;
use PdfReport;
use Illuminate\Support\Facades\DB;
use Excel;
use App\Transaksi;

class ReportController extends Controller
{

    /**
     * Display view of report pembleian
     * return view;
     * author: Hari Setiawan
     */

    public function pembelian()
    {
        return view('pages.report.report_pembelian');
    }

    /**
     * Render report of pembelian by date
     * params: @date_from , @date_till
     * return: pdf report
     * author: Hari Setiawan
     */
    public function reportPembelian(Request $request)
    {
        $data['date_start'] = date('Y-m-d h:i:s',strtotime($request->input('date_start'))) ?? date('Y-m-d h:i:s', strtotime(('01-01-2018')));
        $data['date_end'] = date('Y-m-d h:i:s', strtotime($request->input('date_end'))) ?? date('Y-m-d h:i:s', strtotime(('10-03-2018')));;
        $mode = $request->input('mode');
        if ($mode === "excel") {
            $pembelians = DB::table('transaksis as t')
                ->join('distributors as d', 't.id_distributor', '=', 'd.id_distributor')
                ->select('t.id_transaksi as No Transaksi', 'd.nama_distributor as Nama Distributor', 't.total_harga as Total Harga',
                    't.tgl_transaksi as Tanggal Transaksi')
                ->where('t.type', '=', '0')
                ->whereBetween('t.tgl_transaksi', [$data['date_start'], $data['date_end']])
                ->get();
            $pembelians = json_decode($pembelians, true);
            return Excel::create('report_pembelian', function ($excel) use ($pembelians) {
                $excel->sheet('laporan', function ($sheet) use ($pembelians){
                    $sheet->fromArray($pembelians);
                });
            })->download('xls');
        } else {
            $pembelians = DB::table('transaksis as t')
                ->join('distributors as d', 't.id_distributor', '=', 'd.id_distributor')
                ->select('t.*', 'd.nama_distributor')
                ->where('t.type', '=', '0')
                ->whereBetween('t.tgl_transaksi', [$data['date_start'], $data['date_end']])
                ->get();
            $pembelians = json_decode($pembelians, true);
            $report = PDF::loadView('pages.report.report_layout_pembelian', compact('pembelians', $pembelians));
            return $report->download('report_pembelian.pdf');
        }
    }

    /**
     * Render report of detail pembelian
     * @params $id_transaksi
     * @return pdf report
     * @author Hari Setiawan, S.Kom.
     */
    public function reportDetailPembelian(Request $request, $id)
    {
        $pembelian = DB::table('transaksis')
            ->join('distributors', 'transaksis.id_distributor', '=', 'distributors.id_distributor')
            ->select('transaksis.*', 'distributors.nama_distributor')
            ->where('transaksis.type', '=', '0')
            ->where('transaksis.id_transaksi', '=', $id)
            ->get();
        $detail_pembelian = DB::table('detail_transaksi')
            ->leftJoin('produks', 'detail_transaksi.id_produk', '=', 'produks.id_produk')
            ->leftJoin('satuans', 'produks.id_satuan', '=', 'satuans.id_satuan')
            ->select('detail_transaksi.*', 'produks.*', 'satuans.nama_satuan')
            ->where('detail_transaksi.id_transaksi', '=', $id)
            ->get();
        $pembelian = $pembelian[0];
        $pembelian->detail = $detail_pembelian;
//        return json_encode($pembelian);
        $report = PDF::loadView('pages.report.report_layout_detail_pembelian', compact('pembelian', $pembelian));
        return $report->download('report_detail_pembelian_'.$id.'.pdf');
    }

    /**
     * Display view of report penjualan
     *return view
     * author: Hari Setiawan
     */
    public function penjualan()
    {
        return view('pages.report.report_penjualan');
    }

    /**
     * Render report of penjualan by date
     * params: @date_from , @date_till
     * return: pdf report
     * author: Hari Setiawan
     */
    public function reportPenjualan(Request $request)
    {

        $data['date_start'] = date('Y-m-d h:i:s',strtotime($request->input('date_start'))) ?? date('Y-m-d h:i:s', strtotime(('01-01-2018')));
        $data['date_end'] = date('Y-m-d h:i:s', strtotime($request->input('date_end'))) ?? date('Y-m-d h:i:s', strtotime(('10-03-2018')));;
        $mode = $request->input('mode');
        if ($mode === "excel") {
            $penjualans = DB::table('transaksis as t')
                ->join('pelanggans as p', 't.id_pelanggan', '=', 'p.id_pelanggan')
                ->select('t.id_transaksi as No Transaksi', 'p.nama_pelanggan as Nama Pelanggan', 't.total_harga as Total Harga',
                    't.biaya_kirim as Biaya Kirim', 't.grand_total as Grand Total', 't.tgl_transaksi as Tanggal Transaksi')
                ->where('t.type', '=', '1')
                ->whereBetween('t.tgl_transaksi', [$data['date_start'], $data['date_end']])
                ->get();
            $penjualans = json_decode($penjualans, true);
            return Excel::create('report_penjualan', function ($excel) use ($penjualans) {
                $excel->sheet('laporan', function ($sheet) use ($penjualans){
                    $sheet->fromArray($penjualans);
                });
            })->download('xls');
        } else {
            $penjualans = DB::table('transaksis as t')
                ->join('pelanggans as p', 't.id_pelanggan', '=', 'p.id_pelanggan')
                ->select('t.*', 'p.nama_pelanggan')
                ->where('t.type', '=', '1')
                ->whereBetween('t.tgl_transaksi', [$data['date_start'], $data['date_end']])
                ->get();
            $penjualans = json_decode($penjualans, true);
            $report = PDF::loadView('pages.report.report_layout_penjualan', compact('penjualans', $penjualans));
            return $report->download('report_pembelian.pdf');
        }
    }

    /**
     * Render report of detail penjualan
     * @params $id_transaksi
     * @return pdf report
     * @author Hari Setiawan, S.Kom.
     */
    public function reportDetailPenjualan(Request $request, $id)
    {
        $penjualan = DB::table('transaksis as t')
            ->join('pelanggans as p', 't.id_pelanggan', '=', 'p.id_pelanggan')
            ->select('t.*', 'p.nama_pelanggan')
            ->where('t.type', '=', '1')
            ->where('t.id_transaksi', '=', $id)
            ->get();
        $detail_penjualan = DB::table('detail_transaksi')
            ->leftJoin('produks', 'detail_transaksi.id_produk', '=', 'produks.id_produk')
            ->leftJoin('satuans', 'produks.id_satuan', '=', 'satuans.id_satuan')
            ->select('detail_transaksi.*', 'produks.*', 'satuans.nama_satuan')
            ->where('detail_transaksi.id_transaksi', '=', $id)
            ->get();
        $penjualan = $penjualan[0];
        $penjualan->detail = $detail_penjualan;
//        return json_encode($penjualan);
        $report = PDF::loadView('pages.report.report_layout_detail_penjualan', compact('penjualan', $penjualan));
        return $report->download('report_detail_penjualan_'.$id.'.pdf');
    }
}
