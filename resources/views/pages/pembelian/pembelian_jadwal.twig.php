{% extends 'layout.app' %}
{% block page_style %}
<!-- Data Table styles-->
<link rel="stylesheet" href="vendor/datatables/media/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="vendor/datatables-colvis/css/dataTables.colVis.css">
<!-- END Page Custom CSS-->
{% endblock %}

{% block main_content %}
<!-- START Page content-->
<div class="content-wrapper">
    <h3>Data Auto Purchase Produk dengan Economic Quantity Order
        <small>Anda dapat mengelola Auto Purchase pada halaman ini.</small>
    </h3>
    <ol class="breadcrumb">
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li class="active">Auto Purchase With EQO</li>
    </ol>
    <!-- START DATATABLE 1 -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
<!--                <div class="panel-heading">-->
<!--                    <a href="/eqo/create" class="mb-sm btn btn-info"><span class="fa fa-plus-square"></span> Tambah Aturan EQO</a>-->
<!--                    <a href="#" class="mb-sm btn btn-success"><span class="fa fa-table"></span> Import Dari Excel</a>-->
<!--                </div>-->
                <div class="panel-body">
                    <table id="datatable1" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Annual Purchase Ammount</th>
                            <th>Total Number Of Order</th>
                            <th>Current Number of Order</th>
                            <th>Quantity Per Order</th>
                            <th>Annual Total Cost</th>
<!--                            <th>&nbsp;</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        {% for e in eqo_result %}
                        <tr class="gradeA">
                            <td>{{ e.nama_produk}}</td>
                            <td>{{ e.annual_purchase }}</td>
                            <td>{{ e.number_of_order }}</td>
                            <td>{{ e.current_number_of_order }}</td>
                            <td>{{ e.quantity_per_order }}</td>
                            <td>{{ e.total_cost|number_format(2,',','.') }}</td>
<!--                            <td>-->
<!--                                <a class="mb-sm btn btn-green btn-xs pull-left" href="#">Lihat</a>-->
<!--                            </td>-->
                        </tr>
                        {% endfor %}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END DATATABLE 1 -->
</div>
<!-- END Page content-->
{% endblock %}

{% block page_script %}
<!-- Data Table Scripts-->
<script src="{{ asset('vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<!-- END Page Custom Script-->
{% endblock %}
