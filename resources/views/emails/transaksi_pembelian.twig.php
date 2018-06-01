<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div class="container">
    <div class="row">
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
        </style>
        <ul style="padding: 0; margin: 0; list-style: none;">
            <li class="clearfix">
                <ul class="table_head">
                    <li>Id Transaksi</li>
                    <li>:</li>
                    <li id="id_transaksi">12345</li>
                </ul>
            </li>
            <li class="clearfix">
                <ul class="table_head">
                    <li>Tgl Transaksi</li>
                    <li>:</li>
                    <li id="tgl_transaksi">12345</li>
                </ul>
            </li>
            <li class="clearfix">
                <ul class="table_head">
                    <li>Nama Distributor</li>
                    <li>:</li>
                    <li id="nama_distributor">12345</li>
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
            {% for dt in detail_transaksi %}
                <tr>
                    <td>{{ dt.id_produk }}</td>
                    <td>{{ dt.nama_produk }}</td>
                    <td>{{ dt.id_satuan }}</td>
                    <td>{{ dt.qty }}</td>
                    <td>{{ dt.harga_jual }}</td>
                    <td>{{ dt.harga_jual * dt.qty }}</td>
                </tr>
            {% endfor %}
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>