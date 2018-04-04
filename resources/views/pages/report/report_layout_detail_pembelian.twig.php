<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Pembelian</title>
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
    </style>
</head>
<body>

<div>
    <h2 style="text-align: center;">Laporan Pembelian</h2>
    <p style="text-align: center;">Anything can goes here</p>
    <ul style="padding: 0; margin: 0; list-style: none;">
        <li class="clearfix">
            <ul class="table_head">
                <li>Id Transaksi</li>
                <li>:</li>
                <li id="id_transaksi">{{pembelian.id_transaksi}}</li>
            </ul>
        </li>
        <li class="clearfix">
            <ul class="table_head">
                <li>Tgl Transaksi</li>
                <li>:</li>
                <li id="tgl_transaksi">{{pembelian.tgl_transaksi}}</li>
            </ul>
        </li>
        <li class="clearfix">
            <ul class="table_head">
                <li>Nama Distributor</li>
                <li>:</li>
                <li id="nama_distributor">{{pembelian.nama_distributor}}</li>
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
        {%if pembelian|length > 0%}
        {%for p in pembelian.detail%}
        <tr>
            <td>{{p.id_produk}}</td>
            <td>{{p.nama_produk}}</td>
            <td>{{p.nama_satuan}}</td>
            <td>{{p.qty}}</td>
            <td>{{p.harga|number_format(2, ',', '.')}}</td>
            <td>{{(p.harga * p.qty)|number_format(2, ',', '.')}}</td>
        </tr>
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
