{% extends 'layout.app' %}

{% block main_content %}
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Edit Data User
               <small>Anda bisa melakukan perubahan data user dengan mudah pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li>
                  Master
               </li>
               <li class="active"><a href="/user">User</a></li>
               <li>Edit User</li>
            </ol>
            <!-- START row-->
            <div class="row">
               <div class="col-md-12">
                  <form method="POST" enctype="multipart/form-data" action="{{ url('user') }}/{{ user.id }}" data-parsley-validate="" novalidate="" class="form-horizontal">
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
                                    <input type="text" name="name" value="{{ user.name }}" required="required" class="form-control">
                                    <input type="text" name="_method" hidden="hidden" value="PUT"/>
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
                                        <input type="text" name="email" value="{{user.email}}" class="form-control" required="required">
                                    </div>
                                    <div class="col-sm-3">&nbsp;</div>
                                </div>
                           </fieldset>
                            <fieldset class="last-child">
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-6">
                                        <input type="password" onkeyup="checkPassword();" id="password" name="password" value="{{user.password}}" class="form-control" required="required">
                                        <input type="hidden" id="password_old" name="password_old" value="{{user.password}}" class="form-control" required="required">
                                        <input type="hidden" id="password_change" name="password_change" value="0" class="form-control" required="required">
                                    </div>
                                    <div class="col-sm-3">&nbsp;</div>
                                </div>
                            </fieldset>
                           <fieldset>
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-6">
                                        <textarea name="alamat" class="form-control">{{user.alamat}}</textarea>
                                    </div>
                                    <div class="col-sm-3">&nbsp;</div>
                                </div>
                           </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">No Telepon</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="no_telepon" value="{{ user.no_telepon }}" class="form-control" data-parsley-type="number"/>
                                    </div>
                                    <div class="col-sm-2">&nbsp;</div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">Role</label>
                                    <div class="col-sm-6">
                                        {% set role = user.roles[0].id %}
                                        <select name="role" id="role" class="form-control">
                                            {% if auth_user().id == 1 %}
                                            <option {% if role == 1 %} selected="1" {% endif %} value="1">Admin</option>
                                            {% endif %}
                                            <option {% if role == 2 %} selected="1" {% endif %} value="2">Pegawai</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">&nbsp;</div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">Photo Profile</label>
                                    <div class="col-sm-6">
                                        <img src="{% if user.photo_profile %}{{url('/')}}{{user.photo_profile}}{% else %}{{ asset('app/img/user/02.jpg') }}{% endif %}"
                                             alt="Photo Profile" width="120" height="120" style="object-fit: cover; margin-bottom:10px; border-radius: 5px">
                                        <input type="file" class="form-control" name="photo_profile">
                                    </div>
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
   <script type="text/javascript">
        function checkPassword(){
            var password = $('#password').val();
            var password_old = $('#password_old').val();
            if(password != password_old){
                $('#password_change').val('1');
            }else{
                $('#password_change').val('0');
            }
        };
   </script>
   <!-- END Page Custom Script-->
{% endblock %}
