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
            <h3>Data Pelanggan
               <small>Anda dapat mengelola data pelanggan pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li>
                  Master
               </li>
               <li class="active">Pelanggan</li>
            </ol>
            <!-- START DATATABLE 1 -->
            <div class="row">
               <div class="col-lg-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <a href="/pelanggan/create" class="mb-sm btn btn-info"><span class="fa fa-plus-square"></span> Tambah Pelanggan</a>
                         <button data-target="#import" type="button" data-toggle="modal" class="mb-sm btn btn-success"><span class="fa fa-table"></span> Import Dari Excel</button>
                     </div>
                     <div class="panel-body">
                        <table id="datatable1" class="table table-striped table-hover">
                           <thead>
                              <tr>
                                 <th>Nama Pelanggan</th>
                                 <th>Alamat</th>
                                 <th>Kota</th>
                                 <th>No Telepon</th>
                                 <th>Email</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                            {% for pelanggan in pelanggans %}
                              <tr class="gradeA">
                                 <td>{{ pelanggan.nama_pelanggan }}</td>
                                 <td>{{ pelanggan.alamat }}</td>
                                 <td>{{ pelanggan.kota }}</td>
                                 <td>{{ pelanggan.no_telepon }}</td>
                                 <td>{{ pelanggan.email }}</td>
                                 <td>
                                    <a class="mb-sm btn btn-green btn-xs pull-left" href="pelanggan/{{ pelanggan.id_pelanggan }}/edit">Edit</a>
                                    <!--  <a class="mb-sm btn btn-danger btn-xs" href="#">Delete</a>  -->
                                    <form id="delete_{{pelanggan.id_pelanggan}}" action="{{ url('pelanggan') }}/{{ pelanggan.id_pelanggan }}" method="POST" class="pull-left">
                                        <input type="hidden" name="_method" value="DELETE">&nbsp;
                                        {{csrf_field()}}
                                        <button type="button" id="{{pelanggan.id_pelanggan}}" onclick="deleteUser(this.id)" class="mb-sm btn btn-danger btn-xs">Delete</button>
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
            <form enctype="multipart/form-data" method="post" action="{{ route('pelanggan.import') }}">
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
    <!-- SWEET ALERT-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function deleteUser(id) {
            swal({
                title: "Are you sure?",
                text: "You will delete this user permanently!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    document.getElementById('delete_'+id).submit();
                }
            });
        }
    </script>
{% endblock %}
