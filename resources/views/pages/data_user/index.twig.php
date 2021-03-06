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
            <h3>Data User
               <small>Anda dapat mengelola data user pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li class="active">Data User</li>
            </ol>
            <!-- START DATATABLE 1 -->
            <div class="row">
               <div class="col-lg-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <a href="/user/create" class="mb-sm btn btn-info"><span class="fa fa-plus-square"></span> Tambah User</a>
                     </div>
                     <div class="panel-body">
                        <table id="datatable1" class="table table-striped table-hover table-responsive">
                           <thead>
                              <tr>
                                 <th>Nama Lengkap</th>
                                 <th>Email</th>
                                 <th>Alamat</th>
                                 <th>No Telepon</th>
                                 <th>Role</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              {%for user in users%}
                                  {% if user.roles[0].id == 1 %}
                                    {% set role = 'Admin' %}
                                  {% else %}
                                    {% set role = 'Pegawai' %}
                                  {% endif %}
                                  {% if auth_user().id == 1 and user.id != auth_user().id %}
                                      <tr class="gradeA">
                                         <td>{{user.name}}</td>
                                         <td>{{user.email}}</td>
                                         <td>{{user.alamat}}</td>
                                         <td>{{user.no_telepon}}</td>
                                         <td>{{role}}</td>
                                         <td>
                                            <a class="mb-sm btn btn-green btn-xs pull-left" href="user/{{ user.id }}/edit">Edit</a>
                                            <!--  <a class="mb-sm btn btn-danger btn-xs" href="#">Delete</a>  -->
                                            <form id="delete_{{user.id}}" method="POST" action="{{ url('user') }}/{{ user.id }}">
                                                <input type="hidden" name="_method" value="DELETE"> &nbsp;
                                                {{csrf_field()}}
                                                <button type="button" id="{{user.id}}" onclick="deleteUser(this.id)" class="mb-sm btn btn-danger btn-xs">Delete</button>
                                            </form>
                                         </td>
                                      </tr>
                                  {% elseif role == 'Pegawai' %}
                                      <tr class="gradeA">
                                          <td>{{user.name}}</td>
                                          <td>{{user.email}}</td>
                                          <td>{{user.alamat}}</td>
                                          <td>{{user.no_telepon}}</td>
                                          <td>{{role}}</td>
                                          <td>
                                              <a class="mb-sm btn btn-green btn-xs pull-left" href="user/{{ user.id }}/edit">Edit</a>
                                              <!--  <a class="mb-sm btn btn-danger btn-xs" href="#">Delete</a>  -->
                                              <form id="delete_{{user.id}}" method="POST" action="{{ url('user') }}/{{ user.id }}">
                                                  <input type="hidden" name="_method" value="DELETE"> &nbsp;
                                                  {{csrf_field()}}
                                                  <button type="button" id="{{user.id}}" onclick="deleteUser(this.id)" class="mb-sm btn btn-danger btn-xs">Delete</button>
                                              </form>
                                          </td>
                                      </tr>
                                  {% endif %}
                              {%endfor%}
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
