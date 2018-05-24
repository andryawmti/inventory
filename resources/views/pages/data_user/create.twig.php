{% extends 'layout.app' %}
{% block main_content %}
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Tambah User
               <small>Anda bisa melakukan penambahan user baru dengan mudah pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li class="active"><a href="/user">User</a></li>
               <li>Tambah User</li>
            </ol>
            <!-- START row-->
            <div class="row">
               <div class="col-md-12">
                  <form method="POST" action="{{ url('user') }}" class="form-horizontal" novalidate="" data-parsley-validate="">
                     <!-- START panel-->
                     <div class="panel panel-default">
                        <!--  <div class="panel-heading">
                           <div class="panel-title">Fields validation</div>
                        </div>  -->
                        <div class="panel-body">
                           <!--  <h4>Type validation</h4>  -->
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">Nama Lengkap</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" required="required" class="form-control">
                                    </div>
                                    <div class="col-sm-3">
                                        &nbsp;
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="last-child">
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="email" class="form-control" required="required">
                                    </div>
                                    <div class="col-sm-3">&nbsp;</div>
                                </div>
                            </fieldset>
                            <fieldset class="last-child">
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-6">
                                        <input type="password" id="password" name="password" class="form-control" required="required">
                                    </div>
                                    <div class="col-sm-3">&nbsp;</div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-6">
                                        <textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
                                    </div>
                                    <div class="col-sm-3">&nbsp;</div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">No Telepon</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="no_telepon" class="form-control" data-parsley-type="number"/>
                                    </div>
                                    <div class="col-sm-2">&nbsp;</div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">Role</label>
                                    <div class="col-sm-6">
                                        <select name="role" id="role" class="form-control">
                                            <option value="1">Admin</option>
                                            <option value="2">Pegawai</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">&nbsp;</div>
                                </div>
                            </fieldset>
                           {{ csrf_field() }}
                        </div> <!--end of panel body-->
                        <div class="panel-footer text-center">
                           <button type="submit" class="btn btn-info">Simpan</button>
                           <a href="/user" class="btn btn-warning">Batal</a>
                           <button id="refreshField" type="button" class="btn btn-success"><span class="fa fa-refresh"></span></button>
                        </div>
                     </div>
                     <!-- END panel-->
                  </form>
               </div><!--end div col-md-12-->
            </div>
            <!-- END row-->
         </div>
         <!-- END Page content-->
{% endblock %}

{% block page_script %}
    <!-- START Page Custom Script-->
   <!-- Form Validation-->
   <script src="{{ asset('vendor/parsleyjs/dist/parsley.min.js') }}"></script>

   <!-- END Page Custom Script-->
{% endblock %}
