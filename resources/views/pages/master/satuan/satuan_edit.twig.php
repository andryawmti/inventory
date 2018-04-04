{% extends 'layout.app' %}

{% block main_content %}
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Edit Satuan
               <small>Anda bisa melakukan perubahan data satuan dengan mudah pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li>
                  Master
               </li>
               <li class="active"><a href="/satuan">Satuan</a></li>
               <li>Edit Satuan</li>
            </ol>
            <!-- START row-->
            <div class="row">
               <div class="col-md-12">
                  <form method="POST" action="{{ url('satuan') }}/{{ satuan.id_satuan }}" class="form-horizontal" data-parsley-validate="" novalidate="">
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
                                 <label class="col-sm-2 control-label">Nama Satuan</label>
                                 <div class="col-sm-6">
                                    <input type="text" name="nama_satuan" value="{{ satuan.nama_satuan }}" required="required" class="form-control">
                                    <input type="text" name="_method" hidden="hidden" value="PUT"/>
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
                           <a href="/satuan" class="btn btn-warning">Batal</a>
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