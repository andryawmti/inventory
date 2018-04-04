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
            <h3>Data Produk
               <small>Anda dapat mengelola data produk pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li>
                  Master
               </li>
               <li class="active">Produk</li>
            </ol>
            <!-- START DATATABLE 1 -->
            <div class="row">
               <div class="col-lg-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <a href="{{url('/produk/create')}}" class="mb-sm btn btn-info"><span class="fa fa-plus-square"></span> Tambah Produk</a>
                        <button data-target="#import" type="button" data-toggle="modal" class="mb-sm btn btn-success"><span class="fa fa-table"></span> Import Dari Excel</button>
                     </div>
                     <div class="panel-body">
                        <table id="datatable1" class="table table-striped table-hover table-responsive">
                           <thead>
                              <tr>
                                 <th>Nama Produk</th>
                                 <th>Satuan</th>
                                 <th>Harga Beli</th>
                                 <th>Harga Jual</th>
                                 <th>Stok</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                            {% for produk in produks %}
                              <tr class="gradeA">
                                 <td>{{ produk.nama_produk }}</td>
                                 <td>{{ produk.nama_satuan }}</td>
                                 <td>{{ produk.harga_beli }}</td>
                                 <td>{{ produk.harga_jual }}</td>
                                 <td>{{ produk.stok }}</td>
                                 <td>
                                    <a class="mb-sm btn btn-green btn-xs pull-left" href="produk/{{ produk.id_produk }}/edit">Edit</a>
                                    <!--  <a class="mb-sm btn btn-danger btn-xs" href="#">Delete</a>  -->
                                    <form method="POST" action="{{ url('produk') }}/{{ produk.id_produk }}">
                                        <input type="hidden" name="_METHOD" value="DELETE"> &nbsp;
                                        <button class="mb-sm btn btn-danger btn-xs" href="#">Delete</button>
                                    </form>
                                 </td>
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
{% block page_modal %}
<div class="modal fade" role="dialog" id="import">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" action="{{ route('produk.import') }}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Import produk</h4>
                </div>
                <div class="div modal-body">
                    <input type="file" id="file" name="file" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{% endblock %}
{% block page_script %}
    <!-- START Page Custom Script-->
    <!-- Data Table Scripts-->
    <script src="{{ asset('vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-colvis/js/dataTables.colVis.js') }}"></script>
    <!-- END Page Custom Script-->
{% endblock %}
