{% extends 'layout.app' %}
{% block main_content %}
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Laporan Penjualan
               <small>Anda bisa mencetak laporan penjualan dari halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li>
                  Laporan
               </li>
               <li class="active"><a href="{{route('report.penjualan')}}">Laporan Penjualan</a></li>
            </ol>
            <!-- START row-->
            <div class="row">
               <div class="col-md-12">
                  <form method="POST" action="{{ route('export.penjualan') }}" class="form-horizontal" novalidate="" data-parsley-validate="">
                     <!-- START panel-->
                     <div class="panel panel-default">
                        <!--  <div class="panel-heading">
                           <div class="panel-title">Fields validation</div>
                        </div>  -->
                        <div class="panel-body">
                           <!--  <h4>Type validation</h4>  -->
<!--                           <fieldset>-->
                            <div class="col-sm-2">
                                &nbsp;
                            </div>
                            <div class="col-sm-10">
                                <div style="text-align: left; padding: 0; margin: 0;" class="col-md-12">
                                    <h4>Filter berdasarkan tanggal: </h5>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><strong>Tanggal awal</strong></div><div class="col-md-3"><strong>Tanggal akhir</strong></div><div class="col-md-6">&nbsp;</div>
                                    <div class="col-md-3">
                                        <input type="text" class="date_picker form-control" value="{{ 'now' | date('Y-m-d')}}" name="date_start" readonly="">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="date_picker form-control" value="{{ 'now' | date('Y-m-d')}}" name="date_end" readonly="">
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" name="mode" id="type">
                                            <option value="excel">Excel</option>
                                            <option value="pdf">PDF</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-success"><span class="fa fa-print"></span> Cetak</button>
                                    </div>
                                </div>
                            </div>
<!--                           </fieldset>-->
                           {{ csrf_field() }}
                        </div> <!--end of panel body-->
                        <div class="panel-footer text-center">
                           <a href="{{ url('penjualan') }}" class="btn btn-primary"><span class="fa fa-file-text"></span>&nbsp;Data Penjualan</a>
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
