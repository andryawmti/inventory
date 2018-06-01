{% extends 'layout.app' %}

{% set pembelian = statistik.pembelian %}
{% set penjualan = statistik.penjualan %}

{% block main_content %}
<!-- START Page content-->
<div class="content-wrapper">
    <div class="row">
       <div class="col-lg-12 col-md-12">
          <div class="panel b0">
             <div class="panel-body">
                <div class="row pv-lg">
                   <div class="col-xs-6 col-md-3 text-center">
                      <div class="inline text-left text-center">
                         <div class="lh1 pt">
                            <strong class="text-muted pl-sm">User</strong>
                         </div>
                         <h1 class="mv text-xl text-thin">{{count.user}}</h1>
                         <div class="pt">
                            <div data-type="line" data-height="20" data-width="70" data-line-width="2" data-line-color="#1c75bf" data-spot-color="#fff" data-fill-color="transparent" data-highlight-line-color="#1c75bf" data-spot-radius="0" class="inlinesparkline">4, 4, 6, 5, 3, 4, 5, 6</div>
                         </div>
                      </div>
                   </div>
                   <div class="col-xs-6 col-md-3 text-center">
                      <div class="inline text-left text-center">
                         <div class="lh1 pt">
                            <strong class="text-muted pl-sm">Produk</strong>
                         </div>
                         <h1 class="mv text-xl text-thin">{{count.produk}}</h1>
                         <div class="pt">
                            <div data-type="line" data-height="20" data-width="70" data-line-width="2" data-line-color="#7266ba" data-spot-color="#fff" data-fill-color="transparent" data-highlight-line-color="#7266ba" data-spot-radius="0" class="inlinesparkline">3, 2, 4, 3, 4, 3, 4, 5</div>
                         </div>
                      </div>
                   </div>
                   <div class="col-xs-6 col-md-3 text-center">
                      <div class="inline text-left text-center">
                         <div class="lh1 pt">
                            <strong class="text-muted pl-sm">Pelanggan</strong>
                         </div>
                         <h1 class="mv text-xl text-thin">{{count.pelanggan}}</h1>
                         <div class="pt">
                            <div data-type="line" data-height="20" data-width="70" data-line-width="2" data-line-color="#27c24c" data-spot-color="#fff" data-fill-color="transparent" data-highlight-line-color="#27c24c" data-spot-radius="0" class="inlinesparkline">4, 6, 5, 3, 5, 3, 4, 6</div>
                         </div>
                      </div>
                   </div>
                   <div class="col-xs-6 col-md-3 text-center">
                      <div class="inline text-left text-center">
                         <div class="lh1 pt">
                            <strong class="text-muted pl-sm">Distributor</strong>
                         </div>
                         <h1 class="mv text-xl text-thin">{{count.distributor}}</h1>
                         <div class="pt">
                            <div data-type="line" data-height="20" data-width="70" data-line-width="2" data-line-color="#ff902b" data-spot-color="#fff" data-fill-color="transparent" data-highlight-line-color="#ff902b" data-spot-radius="0" class="inlinesparkline">5, 4, 3, 4, 3, 4, 3, 2, 2</div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             {#<div class="oh">
                 <div style="margin: 10px 10px;">
                     <canvas style="max-height: 40%;" id="canvas"></canvas>
                 </div>
             </div>#}
          </div>
       </div>
    </div>
    <div class="row">
       <div class="col-md-6">
          <div class="panel">
             <div class="panel-heading">
                <div class="panel-title">Statistik Pembelian
                </div>
             </div>
              <div class="oh">
                  <div style="margin: 10px 10px;">
                      <canvas style="max-height: 40%;" id="canvas_pembelian"></canvas>
                  </div>
              </div>
             <!-- END table-responsive-->
          </div>
       </div>
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">Statistik Penjualan
                    </div>
                </div>
                <div class="oh">
                    <div style="margin: 10px 10px;">
                        <canvas style="max-height: 40%;" id="canvas_penjualan"></canvas>
                    </div>
                </div>
                <!-- END table-responsive-->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">Pembelian
                        <a href="{{url('pembelian')}}" class="pull-right">
                            <em class="fa fa-list text-muted"></em>
                        </a>
                        <span class="text-muted">(5 new)</span>
                    </div>
                    <small class="text-muted">5 new pembelian</small>
                </div>
                <!-- START table-responsive-->
                <div class="table-responsive bg-white">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>
                                <strong class="text-gray-darker">
                                    <span class="pl">#Id Transaksi</span>
                                </strong>
                            </th>
                            <th>
                                <strong class="text-gray-darker">Tgl Transaksi</strong>
                            </th>
                            <th width="30%" class="visible-lg visible-sm visible-xs">
                                <strong class="text-gray-darker">Distributor</strong>
                            </th>
                            <th>
                                <strong class="text-gray-darker">Total Harga</strong>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        {% for p in pembelian.list_data %}
                        <tr>
                            <td><a href="{{url('penjualan')}}/{{p.id_transaksi}}/edit">#{{p.id_transaksi}}</a>
                            </td>
                            <td>{{p.tgl_transaksi|date('Y-m-d')}}</td>
                            <td class="visible-lg visible-sm visible-xs">{{p.nama_distributor}}</td>
                            <td>{{p.total_harga}}</td>
                        </tr>
                        {% endfor %}
                        </tbody>
                    </table>
                </div>
                <!-- END table-responsive-->
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">Penjualan
                        <a href="{{url('penjualan')}}" class="pull-right">
                            <em class="fa fa-list text-muted"></em>
                        </a>
                        <span class="text-muted">(5 new)</span>
                    </div>
                    <small class="text-muted">5 new penjualan</small>
                </div>
                <!-- START table-responsive-->
                <div class="table-responsive bg-white">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>
                                <strong class="text-gray-darker">
                                    <span class="pl">#Id Transaksi</span>
                                </strong>
                            </th>
                            <th>
                                <strong class="text-gray-darker">Tgl Transaksi</strong>
                            </th>
                            <th width="30%" class="visible-lg visible-sm visible-xs">
                                <strong class="text-gray-darker">Pelanggan</strong>
                            </th>
                            <th>
                                <strong class="text-gray-darker">Grand Total</strong>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        {% for p in penjualan.list_data %}
                        <tr>
                            <td><a href="{{url('penjualan')}}/{{p.id_transaksi}}/edit">#{{p.id_transaksi}}</a>
                            </td>
                            <td>{{p.tgl_transaksi|date('Y-m-d')}}</td>
                            <td class="visible-lg visible-sm visible-xs">{{p.nama_pelanggan}}</td>
                            <td>{{p.grand_total}}</td>
                        </tr>
                        {% endfor %}
                        </tbody>
                    </table>
                </div>
                <!-- END table-responsive-->
            </div>
        </div>
    </div>
 </div>
 <!-- END Page content-->
{% endblock %}

{% block page_script %}
<script src="https://www.chartjs.org/dist/2.7.2/Chart.bundle.js"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>

<script>
    let pembelian = {{pembelian|json_encode|raw}};
    let penjualan = {{penjualan|json_encode|raw}};
    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var config_pembelian = {
        type: 'line',
        data: {
            labels: pembelian.label,
            datasets: [{
                label: 'Pembelian',
                backgroundColor: window.chartColors.blue,
                borderColor: window.chartColors.blue,
                data:pembelian.data,
                fill: false,
            }]
        },
        options: {
            responsive: true,
            title: {
                display: false,
                text: 'Statistik Transaksi'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Bulan'
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        stepSize: 1
                    },
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Transaksi'
                    }
                }]
            }
        }
    };

    var config_penjualan = {
        type: 'line',
        data: {
            labels: penjualan.label,
            datasets: [{
                label: 'Penjualan',
                backgroundColor: window.chartColors.green,
                borderColor: window.chartColors.green,
                data: penjualan.data,
                fill: false,
            }]
        },
        options: {
            responsive: true,
            title: {
                display: false,
                text: 'Statistik Transaksi'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Bulan'
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        stepSize: 1
                    },
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Transaksi'
                    }
                }]
            }
        }
    };

    window.onload = function() {
        var ctx_pembelian = document.getElementById('canvas_pembelian').getContext('2d');
        window.pembelian = new Chart(ctx_pembelian, config_pembelian);
        console.log(pembelian);

        var ctx_penjualan = document.getElementById('canvas_penjualan').getContext('2d');
        window.penjualan = new Chart(ctx_penjualan, config_penjualan);
        console.log(penjualan);
    };
</script>
{% endblock %}
