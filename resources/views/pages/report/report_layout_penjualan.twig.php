<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Pembelian</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        *{
            font-size: 12px;
        }
        table, td, th {
            border: 1px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 5px;

        table tr td:first-child{
            text-align: center;
        }

        }
    </style>
</head>
<body>

<div>
    <h2 style="text-align: center;">Laporan Pembelian</h2>
    <p style="text-align: center;">Anything can goes here</p>
    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>No Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Total Harga</th>
            <th>Biaya Kirim</th>
            <th>Grand Total</th>
            <th>Tanggal Transaksi</th>
        </tr>
        </thead>
        <tbody>
        {% for i, penjualan in penjualans %}
        <tr>
            <td>{{ i+1 }}</td>
            <td>{{ penjualan.id_transaksi }}</td>
            <td>{{ penjualan.nama_pelanggan }}</td>
            <td>{{ penjualan.total_harga | number_format(2, ',', '.') }}</td>
            <td>{{ penjualan.biaya_kirim | number_format(2, ',', '.') }}</td>
            <td>{{ penjualan.grand_total | number_format(2, ',', '.') }}</td>
            <td>{{ penjualan.tgl_transaksi | date('d-M-Y') }}</td>
        </tr>
        {% endfor %}
        </tbody>
    </table>
</div>

</body>
</html>
