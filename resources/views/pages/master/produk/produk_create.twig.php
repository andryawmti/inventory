{% extends 'layout.app' %}
{% block main_content %}
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Tambah Produk
               <small>Anda bisa melakukan penambahan produk baru dengan mudah pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li>
                  Master
               </li>
               <li class="active"><a href="/produk">Produk</a></li>
               <li>Tambah Produk</li>
            </ol>
            <!-- START row-->
            <div class="row">
               <div class="col-md-12">
                  <form method="POST" action="{{ url('produk') }}" class="form-horizontal" novalidate="" data-parsley-validate="">
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
                                 <label class="col-sm-2 control-label">Nama Produk</label>
                                 <div class="col-sm-6">
                                    <input type="text" name="nama_produk" id="nama_produk" required="required" class="form-control">
                                 </div>
                                 <div class="col-sm-3">
                                    &nbsp;
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset class="last-child">
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">Satuan</label>
                                    <div class="col-sm-6">
                                        <select name="satuan" id="satuan" required="required" class="form-control m-b">
                                            <option value="1">Biji</option>
                                            <option value="2">Bungkus</option>
                                            <option value="3">Kantong</option>
                                            <option value="4">Kotak</option>
                                            <option value="5">Lusin</option>
                                            <option value="6">Pack</option>
                                            <option value="7">Pcs</option>
                                            <option value="8">Unit</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">&nbsp;</div>
                                </div>
                           </fieldset>
                           <fieldset>
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">Harga Beli</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="harga_beli" id="harga_beli" required="required" class="form-control" data-parsley-type="number"/>
                                    </div>
                                    <div class="col-sm-2">&nbsp;</div>
                                </div>
                           </fieldset>
                           <fieldset>
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">Harga Jual</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="harga_jual" id="harga_jual" required="required" class="form-control" data-parsley-type="number"/>
                                    </div>
                                    <div class="col-sm-3">&nbsp;</div>
                                </div>
                           </fieldset>
                           <fieldset>
                                <div class="form-group">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <label class="col-sm-2 control-label">Stok</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="stok" id="stok" required="required" class="form-control" data-parsley-type="number"/>
                                    </div>
                                    <div class="col-sm-3">&nbsp;</div>
                                </div>
                           </fieldset>
                           {{ csrf_field() }}
                        </div> <!--end of panel body-->
                        <div class="panel-footer text-center">
                           <button type="submit" class="btn btn-info">Simpan</button>
                           <a href="/produk" class="btn btn-warning">Batal</a>
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
        /**$('#form-tambah-produk').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/produk/store',
                dataType: 'JSON',
                data: {
                    '_METHOD':'POST',
                    'nama_barang':$('#nama_barang').val(),
                    'satuan':$('#satuan').val(),
                    'saldo_awal':$('#saldo_awal').val(),
                    'stok_awal':$('#stok_awal').val(),
                    'harga_satuan':$('#harga_satuan').val()
                },
                success: function(result,status,xhr){
                    var res = JSON.parse(result);
                    alert(res.message);
                },
                error: function(xhr,status,error){
                    alert('error:'+error);
                }
            });
        });**/
   </script>
   <!-- END Page Custom Script-->
{% endblock %}