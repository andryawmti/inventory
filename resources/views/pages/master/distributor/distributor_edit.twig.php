{% extends 'layout.app' %}

{% block main_content %}
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Edit Distributor
               <small>Anda bisa melakukan perubahan data distributor dengan mudah pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li>
                  Master
               </li>
               <li class="active"><a href="/distributor">Distributor</a></li>
               <li>Edit Distributor</li>
            </ol>
            <!-- START row-->
            <div class="row">
               <div class="col-md-12">
                  <form method="POST" action="{{ url('distributor') }}/{{ distributor.id_distributor }}" class="form-horizontal" data-parsley-validate="" novalidate="">
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
                                 <label class="col-sm-2 control-label">Nama Distributor</label>
                                 <div class="col-sm-6">
                                    <input type="text" name="nama_distributor" value="{{ distributor.nama_distributor }}" required="required" class="form-control">
                                    <input type="text" name="_method" hidden="hidden" value="PUT"/>
                                 </div>
                                 <div class="col-sm-3">
                                    &nbsp;
                                 </div>
                              </div>
                           </fieldset>
                            <fieldset>
                              <div class="form-group">
                                 <div class="col-sm-1">&nbsp;</div>
                                 <label class="col-sm-2 control-label">Alamat </label>
                                 <div class="col-sm-6">
                                    <input type="text" name="alamat" value="{{ distributor.alamat }}" required="required" class="form-control">
                                 </div>
                                 <div class="col-sm-3">
                                    &nbsp;
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <div class="col-sm-1">&nbsp;</div>
                                 <label class="col-sm-2 control-label">Kota</label>
                                 <div class="col-sm-6">
                                    <input type="text" name="kota" value="{{ distributor.kota }}" required="required" class="form-control">
                                 </div>
                                 <div class="col-sm-3">
                                    &nbsp;
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <div class="col-sm-1">&nbsp;</div>
                                 <label class="col-sm-2 control-label">No Telepon</label>
                                 <div class="col-sm-6">
                                    <input type="text" name="no_telepon" value="{{ distributor.no_telepon }}" required="required" class="form-control">
                                 </div>
                                 <div class="col-sm-3">
                                    &nbsp;
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <div class="col-sm-1">&nbsp;</div>
                                 <label class="col-sm-2 control-label">Email</label>
                                 <div class="col-sm-6">
                                    <input type="text" name="email" value="{{ distributor.email }}" required="required" class="form-control">
                                 </div>
                                 <div class="col-sm-3">
                                    &nbsp;
                                 </div>
                              </div>
                           </fieldset>
                           {{ csrf_field() }}
                        </div> <!--end of panel body-->
                        <div class="panel-footer text-center">
                           <button type="submit" class="btn btn-info">Simpan</button>
                           <a href="/distributor" class="btn btn-warning">Batal</a>
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