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
            <th>Nama Distributor</th>
            <th>Total Transaksi</th>
            <th>Tanggal Transaksi</th>
        </tr>
        </thead>
        <tbody>
        {% for i, pembelian in pembelians %}
        <tr>
            <td>{{ i+1 }}</td>
            <td>{{ pembelian.id_transaksi }}</td>
            <td>{{ pembelian.nama_distributor }}</td>
            <td>{{ pembelian.total_harga | number_format(2, ',', '.') }}</td>
            <td>{{ pembelian.tgl_transaksi }}</td>
        </tr>
        {% endfor %}
        </tbody>
    </table>
</div>

</body>
</html>
