{% extends 'layout.app' %}

{% block main_content %}
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Tambah Aturan EQO
               <small>Anda bisa melakukan penambahan Aturan EQO untuk produk pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li class="active"><a href="/eqo">Pengaturan EQO</a></li>
               <li>Tambah Aturan EQO</li>
            </ol>
            <!-- START row-->
            <div class="row">
               <div class="col-md-12">
                  <form method="POST" action="{{ url('eqo') }}" data-parsley-validate="" novalidate="" class="form-horizontal">
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
                                 <label class="col-sm-2 control-label">Produk</label>
                                 <div class="col-sm-6">
                                    <select name="produk_id" required="required" class="form-control">
                                        <option value="0">--Pilih--</option>
                                        {% if produks | length > 0 %}
                                        {% for produk in produks %}
                                            <option value="{{produk.id_produk}}">{{produk.nama_produk}}</option>
                                        {% endfor %}
                                        {% endif %}
                                    </select>
                                 </div>
                                 <div class="col-sm-3">
                                    &nbsp;
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <div class="col-sm-1">&nbsp;</div>
                                 <label class="col-sm-2 control-label"><abbr title="Jumlah unit produk yang dibeli dalam setahun">Unit Per Year</abbr></label>
                                 <div class="col-sm-6">
                                    <input type="text" name="unit_per_year" required="required" class="form-control">
                                 </div>
                                 <div class="col-sm-3">
                                    &nbsp;
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <div class="col-sm-1">&nbsp;</div>
                                 <label class="col-sm-2 control-label"><abbr title="Biaya penyimpanan barang per unit di gudang dalam setahun">Holding Cost</abbr></label>
                                 <div class="col-sm-6">
                                    <input type="text" name="holding_cost" required="required" class="form-control">
                                 </div>
                                 <div class="col-sm-3">
                                    &nbsp;
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <div class="col-sm-1">&nbsp;</div>
                                 <label class="col-sm-2 control-label"><abbr title="Biaya yang dikeluarkan setiap kali melakukan transaksi pembelian">Fixed Cost</abbr></label>
                                 <div class="col-sm-6">
                                    <input type="text" name="fixed_cost" required="required" class="form-control">
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
                           <a href="/eqo" class="btn btn-warning">Batal</a>
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
