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
            <h3>Data Aturan EQO
               <small>Anda dapat mengelola aturan untuk EQO pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li class="active">Pngaturan EQO</li>
            </ol>
            <!-- START DATATABLE 1 -->
            <div class="row">
               <div class="col-lg-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <a href="/eqo/create" class="mb-sm btn btn-info"><span class="fa fa-plus-square"></span> Tambah Aturan EQO</a>
                        <a href="#" class="mb-sm btn btn-success"><span class="fa fa-table"></span> Import Dari Excel</a>
                     </div>
                     <div class="panel-body">
                        <table id="datatable1" class="table table-striped table-hover">
                           <thead>
                              <tr>
                                 <th>Nama Produk</th>
                                 <th>Annual Purchase Ammount</th>
                                 <th>Holding Cost</th>
                                 <th>Fixed Cost</th>
                                 <th>Unit Cost</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                            {% for aturan in aturan_eqo %}
                              <tr class="gradeA">
                                 <td>{{ aturan.nama_produk}}</td>
                                 <td>{{ aturan.annual_purchase }}</td>
                                 <td>{{ aturan.holding_cost }}</td>
                                 <td>{{ aturan.fixed_cost }}</td>
                                 <td>{{ aturan.harga_beli }}</td>
                                 <td>
                                    <a class="mb-sm btn btn-green btn-xs pull-left" href="eqo/{{ aturan.id }}/edit">Edit</a>
                                    <!--  <a class="mb-sm btn btn-danger btn-xs" href="#">Delete</a>  -->
                                    <form id="delete_{{aturan.id}}" action="{{ url('eqo') }}/{{ aturan.id }}" method="POST" class="pull-left">
                                        <input type="hidden" name="_method" value="DELETE">&nbsp;
                                        {{csrf_field()}}
                                        <button type="button" id="{{aturan.id}}" onclick="deleteUser(this.id)" class="mb-sm btn btn-danger btn-xs">Delete</button>
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
