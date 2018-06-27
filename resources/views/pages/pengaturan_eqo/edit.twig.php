{% extends 'layout.app' %}

{% block main_content %}
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Edit Aturan EQO
               <small>Anda bisa melakukan perubahan aturan EQO dengan mudah pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li class="active"><a href="{{url('eqo')}}">Aturan EQO</a></li>
               <li>Edit Aturan</li>
            </ol>
            <!-- START row-->
            <div class="row">
               <div class="col-md-12">
                  <form method="POST" action="{{ url('eqo') }}/{{ aturan.id }}" class="form-horizontal" data-parsley-validate="" novalidate="">
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
                                    <select name="id_produk" required="required" class="form-control">
                                        <option value="0">--Pilih--</option>
                                        {% if produks | length > 0 %}
                                        {% for produk in produks %}
                                            <option {%if aturan.id_produk == produk.id_produk %} selected="selected" {%endif%} value="{{produk.id_produk}}">{{produk.nama_produk}}
                                            </option>
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
                                    <label class="col-sm-2 control-label">Distributor</label>
                                    <div class="col-sm-6">
                                        <select name="id_distributor" required="required" class="form-control">
                                            <option value="0">--Pilih--</option>
                                            {% if distributors | length > 0 %}
                                            {% for d in distributors %}
                                            <option {%if aturan.id_distributor == d.id_distributor%} selected {%endif%} value="{{d.id_distributor}}">{{d.nama_distributor}}</option>
                                            {% endfor %}
                                            {% endif %}
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        &nbsp;
                                    </div>
                                </div>
                            </fieldset>
                           <input type="text" hidden="hidden" name="_method" value="PUT">
                           <fieldset>
                              <div class="form-group">
                                 <div class="col-sm-1">&nbsp;</div>
                                  <label class="col-sm-2 control-label"><abbr title="Jumlah unit produk yang dibeli dalam setahun">Unit Per Year</abbr></label>
                                 <div class="col-sm-6">
                                    <input type="text" name="unit_per_year" required="required" class="form-control" value="{{aturan.annual_purchase}}">
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
                                    <input type="text" name="holding_cost" required="required" class="form-control" value="{{aturan.holding_cost}}">
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
                                    <input type="text" name="fixed_cost" required="required" class="form-control" value="{{aturan.fixed_cost}}">
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
                           <a href="/pelanggan" class="btn btn-warning">Batal</a>
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
