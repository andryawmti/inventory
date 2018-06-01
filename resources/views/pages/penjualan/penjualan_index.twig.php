{% extends "layout.app" %}
{% block page_style %}
  <!-- Data Table styles-->
   <link rel="stylesheet" href="vendor/datatables/media/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="vendor/datatables-colvis/css/dataTables.colVis.css">
   <link rel="stylesheet" href="vendor/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css">
   <link rel="stylesheet" href="vendor/chosen/chosen.css">
   <link rel="stylesheet" href="vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
   <!-- END Page Custom CSS-->
{% endblock %}
{% block main_content %}
        <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Data Penjualan
               <small>Anda dapat mengelola data penjualan pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li class="active">Penjualan</li>
            </ol>
            <!-- START DATATABLE 1 -->
            <div class="row">
               <div class="col-lg-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <div class="row">
                          <div class="col-md-12">
                            <h4>Filter berdasarkan tanggal: </h5>
                          </div>
                          <div class="col-md-3"><strong>Tanggal awal</strong></div><div class="col-md-3"><strong>Tanggal akhir</strong></div><div class="col-md-6">&nbsp;</div>
                          <form action="{{ url('penjualan') }}/search" method="POST">
                            <div class="col-md-3">
                              <input type="text" class="date_picker form-control" value="{{ 'now' | date('Y-m-d')}}" name="date_start" readonly="">
                            </div>
                            {{ csrf_field() }}
                            <div class="col-md-3">
                              <input type="text" class="date_picker form-control" value="{{ 'now' | date('Y-m-d')}}" name="date_last" readonly="">
                            </div>
                            <div class="col-md-3">
                              <button type="submit" class="btn btn-success"><span class="fa fa-search-plus"></span> Tampilkan</button>
                            </div>
                          </form>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <a href="{{ url('penjualan/create') }}" class="mb-sm btn btn-info"><span class="fa fa-plus-square"></span> Tambah Penjualan</a>
                            <a href="{{ route('report.penjualan') }}" class="mb-sm btn btn-info"><span class="fa fa-print"></span> Cetak</a>
                          </div>
                        </div>
                     </div>
                     <div class="panel-body">
                        <table id="datatable1" class="table table-bordered table-striped table-hover">
                           <thead>
                              <tr>
                                 <th>No Transaksi</th>
                                 <th>Nama Pelanggan</th>
                                 <th>Tanggal Transaksi</th>
                                 <th>Total Harga</th>
                                 <th>Biaya Kirim</th>
                                 <th>Grand Total</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                            {% if penjualans|length > 0 %}
                              {% for penjualan in penjualans %}
                              <tr class="gradeA">
                                 <td>{{ penjualan.id_transaksi }}</td>
                                 <td>{{ penjualan.nama_pelanggan }}</td>
                                 <td>{{ penjualan.tgl_transaksi }}</td>
                                 <td>{{ penjualan.total_harga | number_format(2, ',', '.') }}</td>
                                 <td>{{ penjualan.biaya_kirim | number_format(2, ',', '.') }}</td>
                                 <td>{{ penjualan.grand_total | number_format(2, ',', '.') }}</td>
                                 <td>
                                    <a class="mb-sm btn btn-info btn-xs" href="#" id="{{penjualan.id_transaksi}}" onclick="viewDetail(this.id);">Lihat Detail</a>
                                    {#<a class="mb-sm btn btn-info btn-xs" href="{{url('penjualan')}}/{{penjualan.id_transaksi}}/edit" id="edit_{{penjualan.id_transaksi}}">Edit</a>#} &nbsp;
                                    {#<a class="mb-sm btn btn-danger btn-xs" href="#">Delete</a>#}
                                 </td>
                              </tr>
                              {% endfor %}
                            {% endif %}
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
    <!-- START Page Custom Script-->
    <!-- Data Table Scripts-->
    <script src="{{ asset('vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-colvis/js/dataTables.colVis.js') }}"></script>
       <!-- MomentJs and Datepicker-->
   <script src="vendor/moment/min/moment-with-locales.min.js"></script>
   <script src="vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

   <script type="text/javascript">
      function viewDetail(id){
        $.ajax({
            type: 'GET',
            url: "{{ url('penjualan/"+id+"') }}",
            dataType: 'JSON',
            success: function(result,status,xhr){
                //var res = JSON.parse(result);
                console.dir(result);

                let detail_penjualan = result.detail_penjualan;
                let penjualan = result.penjualan[0];
                let tbody = '';

                $('#id_transaksi').html(penjualan.id_transaksi);
                $('#tgl_transaksi').html(penjualan.tgl_transaksi);
                $('#nama_pelanggan').html(penjualan.nama_pelanggan);

                for(var i=0; i < detail_penjualan.length; i++){
                  tbody += '<tr>';
                  tbody += '<td>'+detail_penjualan[i].id_produk+'</td>';
                  tbody += '<td>'+detail_penjualan[i].nama_produk+'</td>';
                  tbody += '<td>'+detail_penjualan[i].id_satuan+'</td>';
                  tbody += '<td>'+detail_penjualan[i].qty+'</td>';
                  tbody += '<td>'+detail_penjualan[i].harga_jual+'</td>';
                  tbody += '<td>'+(detail_penjualan[i].harga_jual * detail_penjualan[i].qty)+'</td>';
                  tbody += '</tr>';
                  if((detail_penjualan.length - i)==1){
                    tbody += '<tr>';
                    tbody += '<td colspan="5">Total keseluruhan: </td>';
                    tbody += '<td>'+penjualan.total_harga+'</td>';
                    tbody += '</tr>';
                    tbody += '<tr>';
                    tbody += '<td colspan="5">Biaya kirim: </td>';
                    tbody += '<td>'+penjualan.biaya_kirim+'</td>';
                    tbody += '</tr>';
                    tbody += '<tr>';
                    tbody += '<td colspan="5">Grand total: </td>';
                    tbody += '<td>'+penjualan.grand_total+'</td>';
                    tbody += '</tr>';
                  }
                }

                $('#detail_penjualan').html(tbody);
                $('#cetak_detail').attr("href","{{url('report/detail-penjualan')}}/"+id);
                $('#barang_dikirim').attr("href","{{url('/barang-dikirim')}}/"+id);
                if (penjualan.is_delivered) {
                    //$('#barang_dikirim').css('display', 'none');
                } else {
                    //$('#barang_dikirim').css('display', 'inline');
                }
                $('#view_modal').modal('show');
            },
            error: function(xhr,status,error){
                alert('error:'+error);
            }
        });
      }

      $(document).ready(function(){
          $('#barang_dikirim').click(function(e){
              e.preventDefault();
              if (confirm('Apakah anda yakin?')) {
                  let url = $('#barang_dikirim').attr('href');
                  window.location = url;
              }
          });
      });
    </script>
{% endblock %}

{% block page_modal %}
  <div id="view_modal" class="modal fade">
     <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Detail Penjualan</h4>
          </div>
          <div class="modal-body">
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
                  <li id="nama_pelanggan">12345</li>
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
              <tbody id="detail_penjualan">
                <tr style="text-align: center;">
                  <td colspan="6">No data found</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
              <a href="" id="barang_dikirim" style="display: none;" class="btn btn-success btn-sm"><span class="fa fa-print"></span>&nbsp;Konfirmasi Barang Dikirim</a>
              <a href="" id="cetak_detail" class="btn btn-info btn-sm"><span class="fa fa-print"></span>&nbsp;Cetak</a>
          </div>
       </div>
     </div>
   </div>
{% endblock %}
