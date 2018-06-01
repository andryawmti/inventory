{% extends "layout.app" %}
{% block page_meta %}
  <meta name="csrf-token" content="{{ csrf_token() }}">
{% endblock %}
{% block page_style %}
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
{% endblock %}
{% set pelanggans = params.pelanggans %}
{% set produks = params.produks %}
{% block main_content %}
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Tambah Transaksi Penjualan
               <small>Anda bisa melakukan penambahan transaksi penjualan dengan mudah pada halaman ini.</small>
            </h3>
            <ol class="breadcrumb">
               <li>
                  <a href="/">Dashboard</a>
               </li>
               <li class="active"><a href="/penjualan">Penjualan</a></li>
               <li>Tambah Penjualan</li>
            </ol>
            <!-- START row-->
            <div class="row">
               <div class="col-md-12">
                  <form method="POST" id="createPenjualan" action="{{ url('/penjualan/store') }}" data-parsley-validate = "" novalidate="" class="form-horizontal">
                     <!-- START panel-->
                     <div class="panel panel-default">
                        <!--  <div class="panel-heading">
                           <div class="panel-title">Fields validation</div>
                        </div>  -->
                        <div class="panel-body">
                          <div class="form-group">
                             <label class="col-sm-2 text-left control-label">Tanggal Transaksi</label>
                             <div class="col-sm-3">
                                <input type="text" id="tgl_transaksi" class="form-control date_picker" readonly="readonly" value="{{ "now" | date('Y-m-d') }}" required="required" class="form-control">
                             </div>
                             <label class="col-sm-2 text-left control-label">Planggan</label>
                             <div class="col-sm-3">
                                <select id="id_pelanggan" required="required" class="form-control">
                                  {% if pelanggans %}
                                    {% for pelanggan in pelanggans %}
                                      <option value="{{ pelanggan.id_pelanggan }}">
                                      {{ pelanggan.nama_pelanggan }}
                                      </option>
                                    {% endfor %}
                                  {% else %}
                                    <option>Tidak ada pelanggan</option>
                                  {% endif %}
                                </select>
                             </div>
                          </div>
                          <br>
                           <h4>Barang yang dijual: </h4>
                          <div class="table table-bordered table-responsive table-striped">
                             <table class="table">
                                <thead>
                                   <tr>
                                      <th>Id</th>
                                      <th>Nama Barang</th>
                                      <th>Qty</th>
                                      <th>Satuan</th>
                                      <th>Harga Satuan</th>
                                      <th>Harga Total</th>
                                      <th>Manage</th>
                                   </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td><a class="btn btn-xs btn-success" onclick="showDialog()" id="tambahBarangBtns">Tambah</a></td>
                                   </tr>
                                   <tr style="background: #0288D1; color: #FFFFFF;">
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td colspan="2">
                                        <div class="col-md-6">
                                          <label class="pull-right" for="biaya_kirim">Biaya Kirim: </label>
                                        </div>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" id="biaya_kirim" value="0" placeholder="Biaya kirim">
                                        </div>
                                      </td>
                                     <td><strong>Total: </strong>&nbsp;&nbsp;&nbsp;<strong id="total">0</strong></td>
                                   </tr>
                                </tbody>
                             </table>
                          </div>
                        </div> <!--end of panel body-->

                        <div class="panel-footer text-center">
                           <button type="submit" class="btn btn-info">Simpan</button>
                           <a href="{{ url('penjualan') }}" class="btn btn-warning">Kembali</a>
                           <button type="button" onclick="resetProduk()" class="btn btn-success"><span class="fa fa-refresh"></span></button>
                        </div>
                     </div>
                     <!-- END panel-->
                  </form>
               </div><!--end div col-md-12-->
            </div>
            <!-- END row-->
         </div>
{% endblock %}

{% block page_modal %}
<div class="modal fade" id="modal_tambah_produk" title="Tambah Produk">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pilih produk yang akan ditambahkan.</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-lg-2">&nbsp;</div>
                    <label class="col-lg-1 control-label">Produk</label>
                    <div class="col-lg-7">
                        <select id="id_produk" class="form-control">
                            {% if produks | length > 0 %}
                            <option value="">Pilih Produk</option>
                            {% for produk in produks %}
                            <option value="{{ produk.id_produk }}">{{ produk.nama_produk }}</option>
                            {% endfor %}
                            {% else %}
                            <option value="">Belum ada produk</option>
                            {% endif %}
                        </select>
                        <input type="hidden" id="nama_produk">
                    </div>
                    <div class="col-lg-2">&nbsp;</div>
                </div>
                <div class="form-group">
                    <div class="col-lg-2">&nbsp;</div>
                    <label class="col-lg-1 control-label">Qty</label>
                    <div class="col-lg-7">
                        <input type="text" placeholder="Qty" id="qty" class="form-control">
                    </div>
                    <div class="col-lg-2">&nbsp;</div>
                </div>
                <div class="form-group">
                    <div class="col-lg-2">&nbsp;</div>
                    <label class="col-lg-1 control-label">Satuan</label>
                    <div class="col-lg-7">
                        <input type="text" placeholder="Satuan" id="satuan" class="form-control" readonly="readonly">
                    </div>
                    <div class="col-lg-2">&nbsp;</div>
                </div>
                <div class="form-group">
                    <div class="col-lg-2">&nbsp;</div>
                    <label class="col-lg-1 control-label">Harga</label>
                    <div class="col-lg-7">
                        <input type="text" placeholder="Harga" id="harga" class="form-control" readonly="readonly">
                    </div>
                    <div class="col-lg-2">&nbsp;</div>
                </div>

            </div>
            <div style="text-align: center;" class="modal-footer">
<!--                <div class="form-group">-->
                    <button onclick="tambahBarang();" type="button" class="btn btn-info btn-sm">Tambahkan</button>
                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Tutup</button>
<!--                </div>-->
            </div>
            </form>
        </div>
    </div>
</div>
{% endblock %}

{% block page_script %}
    <!-- START Page Custom Script-->
   <!-- Form Validation-->
   <script src="{{ asset('vendor/parsleyjs/dist/parsley.min.js') }}"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script type="text/javascript">
      function showDialog(){
          $('#modal_tambah_produk').modal('show');
      }
      // define array of object for produks
      let produks = [];
      console.dir(produks);
      console.log(Object.size(produks));
      function tambahBarangExecute(){
          let id_produk = $('#id_produk').val();
          let nama_produk = $('#nama_produk').val();
          let qty = parseInt($('#qty').val());
          let harga = parseInt($('#harga').val());
          let satuan = $('#satuan').val();
          let total = parseInt($('#total').html());

          total = total + (qty * harga);
          let produk = {'id_produk':id_produk,'nama_produk':nama_produk,'qty':qty,'nama_satuan':satuan,'harga':harga};

          $('#total').html(total);

          produks.push(produk)
          var count = Object.size(produks);
          if (count > 0) {
              count = count - 1;
          }
          $('#id_produk').val("");
          $('#qty').val("");
          $('#harga').val("");
          $('#satuan').val("");
          $('#nama_produk').val("");

          let table_row = '<tr><td>'+id_produk+'</td><td>'+nama_produk+'</td><td>'+qty+'</td><td>'+satuan+'</td><td>'+harga+'</td><td>'+(harga * qty)+'</td><td><a href="#" id = "'+(count)+'" onclick="hapusProduk(this)">Hapus</a></td></tr>';
          let tbody = $('tbody').html();
          $('tbody').html(table_row+tbody);
          console.dir(produks);
      }

      $('#id_produk').change(function(){
          let id_produk = $(this).val();
          if(id_produk != ""){
            getHargaProduk(id_produk);
          }else{
            $('#harga').val("");
          }
      });

      function getHargaProduk(id_produk){
          $.ajax({
              type: 'GET',
              url: "{{ url('get_harga_produk') }}/"+id_produk,
              dataType: 'JSON',
              success: function(result,status,xhr){
                  // var res = JSON.parse(result);
                  // console.dir(result);
                  $('#nama_produk').val(result.nama_produk);
                  $('#harga').val(result.harga_jual);
                  $('#satuan').val(result.nama_satuan);
              },
              error: function(xhr,status,error){
                  alert('error:'+error);
              }
          });
      }

      $('#createPenjualan').on('submit', function(e){
          if(produks.length <= 0) {
            alert('Anda belum menambahkan produk');
            return false;
          }
          e.preventDefault();
          let id_pelanggan = $('#id_pelanggan').val();
          let tgl_transaksi = $('#tgl_transaksi').val();
          let total = $('#total').html();
          let biaya_kirim = $('#biaya_kirim').val();
          $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'POST',
              url: "{{ url('penjualan') }}",
              dataType: 'JSON',
              data: {
                  'produks':produks, 'id_pelanggan':id_pelanggan, 'tgl_transaksi':tgl_transaksi, 'total':total, 'biaya_kirim':biaya_kirim
              },
              success: function(result,status,xhr){
                  alert(result.message);
                  produks = [];
                  setTimeout(function(){
                      window.location = "{{ url('penjualan') }}";
                  }, 1000);
              },
              error: function(xhr,status,error){
                  alert('error:'+error);
              }
          });
      });

      function resetProduk() {
          if(confirm('Apakah anda yakin?')) {
              let tbody = document.getElementsByTagName('tbody');
              let tbodyContent = '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td><a class="btn btn-xs btn-success" onclick="showDialog()" id="tambahBarangBtns">Tambah</a></td></tr><tr style="background: #0288D1; color: #FFFFFF;"><td></td><td></td><td></td><td></td><td colspan="2" style="max-width: 150px;"><div class="col-md-6"><label class="pull-right" for="biaya_kirim">Biaya Kirim: </label></div><div class="col-md-6"><input type="text" class="form-control" id="biaya_kirim" value="0" placeholder="Biaya kirim"></div></td><td style="font-size: 18px;"><strong>Total: </strong>&nbsp;&nbsp;&nbsp;<strong id="total">0</strong></td></tr>';
              tbody[0].innerHTML = tbodyContent;
          }

      }

      function hapusProduk(element){
          var parent_element = element.parentElement.parentElement;
          if(confirm('Apakah anda yakin?')) {
              produks.splice(element.id, 1);
              let table_row = '';
              let total = 0;
              for(let i=0; i < Object.size(produks); i++){
                  table_row += '<tr><td>'+produks[i].id_produk+'</td><td>'+produks[i].nama_produk+'</td><td>'+produks[i].qty+'</td><td>'+produks[i].nama_satuan+'</td><td>'+produks[i].harga+'</td><td>'+(produks[i].harga * produks[i].qty)+'</td><td><a href="#" id = "'+i+'" onclick="hapusProduk(this)">Hapus</a></td></tr>';
                  total = total + parseInt(produks[i].harga * produks[i].qty);
              }
              let biaya_kirim = $('#biaya_kirim').val();
              console.log('biaya_kirim:'+biaya_kirim);
              let body = '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td><a class="btn btn-xs btn-success" onclick="showDialog()" id="tambahBarangBtns">Tambah</a></td></tr>';
              body += '<tr style="background: #0288D1; color: #FFFFFF;">\n' +
                  '                                    <td></td>\n' +
                  '                                    <td></td>\n' +
                  '                                    <td></td>\n' +
                  '                                    <td></td>\n' +
                  '                                    <td colspan="2">\n' +
                  '                                        <div class="col-md-6">\n' +
                  '                                            <label class="pull-right" for="biaya_kirim">Biaya Kirim: </label>\n' +
                  '                                        </div>\n' +
                  '                                        <div class="col-md-6">\n' +
                  '                                            <input type="text" class="form-control" id="biaya_kirim" value="{{penjualan.biaya_kirim}}" placeholder="Biaya kirim">\n' +
                  '                                        </div>\n' +
                  '                                    </td>\n' +
                  '                                    <td><strong>Total: </strong>&nbsp<strong id="total"></strong></td>\n' +
                  '                                </tr>';
              let tbody = $.parseHTML(table_row+body);
              $('tbody').html('');
              $('tbody').append(tbody);
              $('#total').html(total);
              console.log('total:'+total);
              console.dir(produks);
              $('#biaya_kirim').val(biaya_kirim);
          }
      }

       function tambahBarang(){
           let id = $('#id_produk').val();
           let qty = $('#qty').val();
           if (id == '') {
               alert('Maaf anda belum memilih produk!');
               return false;
           } else if (qty == '') {
               alert('Maaf anda belum memasukan jumlah quantitas!')
               return false;
           }
           qty = parseInt($('#qty').val())
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ url('cek-ketersediaan') }}",
                dataType: 'JSON',
                data: {
                    'id':id,'qty':qty
                },
                success: function(result,status,xhr){
                    if (result.result<1) {
                        alert('Stok tidak tersedia, stok tersisa : '+result.stok);
                    }else{
                        tambahBarangExecute();
                    }
                },
                error: function(xhr,status,error) {
                    alert('error:' + error);
                }
            });

       }

   </script>
   <!-- END Page Custom Script-->
{% endblock %}
