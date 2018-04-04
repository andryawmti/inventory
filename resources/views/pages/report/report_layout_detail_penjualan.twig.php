<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Penjualan</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        table, td, th {
            border: 1px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 10px;
        }
    </style>

    <style>
        .table_head{
            padding:0;
            margin:0;
            list-style: none;
        }
        .table_head li{
            float: left;
            padding: 5px 10px;
        }
        .table_head li:first-child{
            min-width: 120px;
        }
        .clearfix {
            overflow: auto;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        thead tr td{
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div>
    <h2 style="text-align: center;">Laporan Penjualan</h2>
    <p style="text-align: center;">Anything can goes here</p>
    <ul style="padding: 0; margin: 0; list-style: none;">
        <li class="clearfix">
            <ul class="table_head">
                <li>Id Transaksi</li>
                <li>:</li>
                <li id="id_transaksi">{{penjualan.id_transaksi}}</li>
            </ul>
        </li>
        <li class="clearfix">
            <ul class="table_head">
                <li>Tgl Transaksi</li>
                <li>:</li>
                <li id="tgl_transaksi">{{penjualan.tgl_transaksi}}</li>
            </ul>
        </li>
        <li class="clearfix">
            <ul class="table_head">
                <li>Nama Pelanggan</li>
                <li>:</li>
                <li id="nama_pelanggan">{{penjualan.nama_pelanggan}}</li>
            </ul>
        </li>
    </ul>
    <br>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <td>Id Barang</td>
            <td>Nama Barang</td>
            <td>Satuan</td>
            <td>Qty</td>
            <td>Harga Satuan</td>
            <td>Harga Total</td>
        </tr>
        </thead>
        <tbody id="detail_pembelian">
        {%if penjualan.detail|length > 0%}
        {%for i, p in penjualan.detail%}
        <tr>
            <td>{{p.id_produk}}</td>
            <td>{{p.nama_produk}}</td>
            <td>{{p.nama_satuan}}</td>
            <td>{{p.qty}}</td>
            <td style="text-align: right">{{p.harga|number_format(2, ',', '.')}}</td>
            <td style="text-align: right">{{(p.harga * p.qty)|number_format(2, ',', '.')}}</td>
        </tr>
        {%if (penjualan.detail|length) - 1 == 0%}
        <tr>
            <td colspan="5">Total keseluruhan: </td>
            <td style="text-align: right">{{penjualan.total_harga|number_format(2, ',', '.')}}</td>
        </tr>
        <tr>
            <td colspan="5">Biaya kirim: </td>
            <td style="text-align: right">{{penjualan.biaya_kirim|number_format(2, ',', '.')}}</td>
        </tr>
        <tr>
            <td colspan="5">Grand total: </td>
            <td style="text-align: right">{{penjualan.grand_total|number_format(2, ',', '.')}}</td>
        </tr>
        {%endif%}
        {%endfor%}
        {%else%}
        <tr style="text-align: center;">
            <td colspan="6">No data found</td>
        </tr>
        {%endif%}
        </tbody>
    </table>
</div>

</body>
</html>
