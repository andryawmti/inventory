{% extends "layout.app" %}
{% block page_style %}
  <!-- Data Table styles-->
   <link rel="stylesheet" href="vendor/datatables/media/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="vendor/datatables-colvis/css/dataTables.colVis.css">
   <!-- END Page Custom CSS-->
{% endblock %}
{% block main_content %}
        <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Data Pembelian
               <small>Anda dapat mengelola data pembelian pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li class="active">Pembelian</li>
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
                          <form action="{{ url('pembelian') }}/search" method="POST">
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
                            <a href="{{ url('pembelian/create') }}" class="mb-sm btn btn-info"><span class="fa fa-plus-square"></span> Tambah Pembelian</a>
                            <a href="{{ route('report.pembelian') }}" class="mb-sm btn btn-info"><span class="fa fa-print"></span> Cetak</a>
                          </div>
                        </div>
                     </div>
                     <div class="panel-body">
                        <table id="datatable1" class="table table-striped table-hover">
                           <thead>
                              <tr>
                                 <th>No Transaksi</th>
                                 <th>Nama Supplier</th>
                                 <th>Tanggal Transaksi</th>
                                 <th>Total Harga</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                            {% if pembelians|length > 0 %}
                              {% for pembelian in pembelians %}
                              <tr class="gradeA">
                                 <td>{{ pembelian.id_transaksi }}</td>
                                 <td>{{ pembelian.nama_distributor }}</td>
                                 <td>{{ pembelian.tgl_transaksi }}</td>
                                 <td>{{ pembelian.total_harga | number_format(2, ',', '.') }}</td>
                                 <td>
                                    <a class="mb-sm btn btn-info btn-xs" id="{{pembelian.id_transaksi}}" href="#" onclick="viewDetail(this.id)">Lihat Detail</a>
                                    <a class="mb-sm btn btn-info btn-xs" id="edit_{{pembelian.id_transaksi}}" href="{{url('/pembelian/')}}/{{pembelian.id_transaksi}}/edit">Edit</a>&nbsp;
                                    <!-- <a class="mb-sm btn btn-danger btn-xs" href="#">Delete</a> -->
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
    <!-- END Page Custom Script-->
    <script type="text/javascript">
      function viewDetail(id){
        $.ajax({
            type: 'GET',
            url: "{{ url('pembelian/"+id+"') }}",
            dataType: 'JSON',
            success: function(result,status,xhr){
                //var res = JSON.parse(result);
                console.dir(result);

                let detail_pembelian = result.detail_pembelian;
                let pembelian = result.pembelian[0];
                let tbody = '';

                $('#id_transaksi').html(pembelian.id_transaksi);
                $('#tgl_transaksi').html(pembelian.tgl_transaksi);
                $('#nama_distributor').html(pembelian.nama_distributor);

                for(var i=0; i < detail_pembelian.length; i++){
                  tbody += '<tr>';
                  tbody += '<td>'+detail_pembelian[i].id_produk+'</td>';
                  tbody += '<td>'+detail_pembelian[i].nama_produk+'</td>';
                  tbody += '<td>'+detail_pembelian[i].id_satuan+'</td>';
                  tbody += '<td>'+detail_pembelian[i].qty+'</td>';
                  tbody += '<td>'+detail_pembelian[i].harga_jual+'</td>';
                  tbody += '<td>'+(detail_pembelian[i].harga_jual * detail_pembelian[i].qty)+'</td>';
                  tbody += '</tr>';
                  if((detail_pembelian.length - i)==1){
                    tbody += '<tr>';
                    tbody += '<td colspan="5">Total keseluruhan: </td>';
                    tbody += '<td>'+pembelian.total_harga+'</td>';
                    tbody += '</tr>';
                  }
                }

                $('#detail_pembelian').html(tbody);
                $('#cetak_detail').attr("href","{{url('report/detail-pembelian')}}/"+id);
                $('#barang_diterima').attr("href","{{url('/barang-diterima')}}/"+id);
                if (pembelian.is_delivered) {
                    $('#barang_diterima').css('display', 'none');
                } else {
                    $('#barang_diterima').css('display', 'inline');
                }
                $('#view_modal').modal('show');
            },
            error: function(xhr,status,error){
                alert('error:'+error);
            }
        });
      }
      $(document).ready(function(){
          $('#barang_diterima').click(function(e){
              e.preventDefault();
              if (confirm('Apakah anda yakin?')) {
                  let url = $('#barang_diterima').attr('href');
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
                  <h4 class="modal-title">Detail Pembelian</h4>
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
                      <tr style="text-align: center;">
                        <td colspan="6">No data found</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                    <a href="" id="barang_diterima" class="btn btn-success btn-sm"><span class="fa fa-print"></span>&nbsp;Konfirmasi Barang Diterima</a>
                    <a href="" id="cetak_detail" class="btn btn-info btn-sm"><span class="fa fa-print"></span>&nbsp;Cetak</a>
                </div>
             </div>
           </div>
         </div>
{% endblock %}
