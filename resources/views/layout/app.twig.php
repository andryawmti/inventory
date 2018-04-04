<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie ie6 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="ie ie7 lt-ie9 lt-ie8"        lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="ie ie8 lt-ie9"               lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="ie ie9"                      lang="en"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-ie">
<!--<![endif]-->

<head>
   <!-- Meta-->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
   <meta name="description" content="">
   <meta name="keywords" content="">
   <meta name="author" content="">

   {% block page_meta %}

   {% endblock %}

   <title>{{ config('app.name') }}</title>
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries-->
   <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
   <!-- Bootstrap CSS-->
   <!-- <link rel="stylesheet" href="{{ asset('app/css/bootstrap.css') }}"> -->
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
   <!-- Vendor CSS-->
   <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
   <link rel="stylesheet" href="{{ asset('vendor/animo.js/animate-animo.css') }}">
   <link rel="stylesheet" href="{{ asset('vendor/whirl/dist/whirl.css') }}">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <!-- START Page Custom CSS-->
   {% block page_style %}

   {% endblock %}
   <!-- END Page Custom CSS-->
   <!-- App CSS-->
   <link rel="stylesheet" href="{{ asset('app/css/app.css') }}">
   <!-- Modernizr JS Script-->
   <script src="{{ asset('vendor/modernizr/modernizr.custom.js') }}" type="application/javascript"></script>
   <!-- FastClick for mobiles-->
   <script src="{{ asset('vendor/fastclick/lib/fastclick.js') }}" type="application/javascript"></script>
<!--   <script src="ga.js"></script>-->
   <style>
        span.fa{
            font-size: 15px;
        }
        {% block style %}

        {% endblock %}
   </style>

</head>

<body>
   <!-- START Main wrapper-->
   <div class="wrapper">
      <!-- START Top Navbar-->
      <nav role="navigation" class="navbar navbar-default navbar-top navbar-fixed-top">
         <!-- START navbar header-->
         <div class="navbar-header">
            <a href="dashboard.v1.html" class="navbar-brand">
               <div class="brand-logo">
                  <img src="{{ asset('app/img/logo.png') }}" alt="App Logo" class="img-responsive">
                  <!-- <h4>Inventory System</h4> -->
               </div>
               <div class="brand-logo-collapsed">
                  <img src="{{ asset('app/img/logo-single.png') }}" alt="App Logo" class="img-responsive">
               </div>
            </a>
         </div>
         <!-- END navbar header-->
         <!-- START Nav wrapper-->
         <div class="nav-wrapper">
            <!-- START Left navbar-->
            <ul class="nav navbar-nav">
               <li>
                  <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                  <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                     <em class="fa fa-navicon"></em>
                  </a>
                  <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                  <a href="#" data-toggle-state="aside-toggled" class="visible-xs">
                     <em class="fa fa-navicon"></em>
                  </a>
               </li>
            </ul>
            <!-- END Left navbar-->
            <!-- START Right Navbar-->
            <ul class="nav navbar-nav navbar-right">
               <!-- Fullscreen-->
               <!-- <li>
                  <a href="#" data-toggle="fullscreen">
                     <em class="fa fa-expand"></em>
                  </a>
               </li> -->
               <!-- START Alert menu-->
               <li class="dropdown dropdown-list">
                  <a href="#" data-toggle="dropdown" data-play="flipInX" class="dropdown-toggle">
                     <p style="display: inline;"><strong>Halo, {{auth_user().name}} </strong></p>
                     <em class="fa fa-user"></em>
                     <!-- <div class="label label-danger">11</div> -->
                  </a>
                  <!-- START Dropdown menu-->
                  <ul class="dropdown-menu">
                     <li>
                        <!-- START list group-->
                        <div class="list-group">
                           <!-- list item-->
                           <a href="/profile/{{auth_user().id}}" class="list-group-item">Profile</a>
                           <!-- last list item-->
                           <a class="list-group-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                        <!-- END list group-->
                     </li>
                  </ul>
                  <!-- END Dropdown menu-->
               </li>
               <!-- END Alert menu-->
            </ul>
            <!-- END Right Navbar-->
         </div>
         <!-- END Nav wrapper-->
      </nav>
      <!-- END Top Navbar-->
      <!-- START aside-->
      <aside class="aside">
         <!-- START Sidebar (left)-->
         <nav class="sidebar">
            <!-- START user info-->
            <div class="item user-block">
               <!-- User picture-->
               <div class="user-block-picture">
                  <div class="user-block-status">
                     <img src="{{ asset('app/img/user/02.jpg') }}" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                     <div class="circle circle-success circle-lg"></div>
                  </div>
                  <!-- Status when collapsed-->
               </div>
               <!-- Name and Role-->
               <div class="user-block-info">
                  <span class="user-block-name item-text">Welcome User</span>
                  <span class="user-block-role">UX-Dev</span>
               </div>
            </div>
            <!-- END user info-->
            <ul class="nav">
               <!-- START Menu-->
               <li class="nav-heading">Main navigation</li>
               <li>

                    <a href="/" title="Dashboard" data-toggle="" class="no-submenu">
                        <em class="fa fa-dot-circle-o"></em>
                        <span class="item-text">Dashboard</span>
                    </a>
               </li>
               <li>
                    <a href="#" title="Master" data-toggle="collapse-next" class="has-submenu">
                        <em class="fa fa-database"></em>
                        <span class="item-text">Master</span>
                    </a>
                    <!--  START Submenu item  -->
                    <ul class="nav collapse">
                        <li>
                            <a href="/produk" title="Produk" data-toggle="" class="no-submenu">
                                <span class="item-text">Produk</span>
                            </a>
                        </li>
                        <li>
                            <a href="/satuan" title="Satuan" data-toggle="" class="no-submenu">
                                <span class="item-text">Satuan</span>
                            </a>
                        </li>
                        <li>
                            <a href="/distributor" title="Distributor" data-toggle="" class="no-submenu">
                                <span class="item-text">Distributor</span>
                            </a>
                        </li>
                        <li>
                            <a href="/pelanggan" title="Pelanggan" data-toggle="" class="no-submenu">
                                <span class="item-text">Pelanggan</span>
                            </a>
                        </li>
                    </ul>
                    <!--  END Submenu item  -->
               </li>
               <li>
                  <a href="/pembelian" title="Pembelian" data-toggle="" class="no-submenu">
                     <em class="fa fa-list-alt"></em>
                     <span class="item-text">Pembelian</span>
                  </a>
               </li>
               <li>
                  <a href="/penjualan" title="Penjualan" data-toggle="" class="no-submenu">
                     <em class="fa fa-area-chart"></em>
                     <span class="item-text">Penjualan</span>
                  </a>
               </li>
               <li>
                  <a href="/user" title="DataUser" data-toggle="" class="no-submenu">
                     <em class="fa fa-user"></em>
                     <span class="item-text">Data User</span>
                  </a>
               </li>
               <li>
                  <a href="{{route('auto.purchase')}}" title="Jadwal Pembelian" data-toggle="" class="no-submenu">
                     <em class="fa fa-calendar"></em>
                     <span class="item-text">Auto Purchase</span>
                  </a>
               </li>
               <li>
                    <a href="#" title="Laporan" data-toggle="collapse-next" class="has-submenu">
                        <em class="fa fa-print"></em>
                        <span class="item-text">Laporan </span>
                    </a>
                    <!--  START Submenu item  -->
                    <ul class="nav collapse">
                        <li>
                            <a href="{{route('report.pembelian')}}" title="Laporan Pembelian" data-toggle="" class="no-submenu">
<!--                                <em class="fa fa-list-alt"></em>-->
                                <span class="item-text">Pembelian</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('report.penjualan')}}" title="Laporan Penjualan" data-toggle="" class="no-submenu">
<!--                                <em class="fa fa-area-chart"></em>-->
                                <span class="item-text">Penjualan</span>
                            </a>
                        </li>
                    </ul>
                    <!--  END Submenu item  -->
               </li>
               <li>
                  <a href="/eqo" title="Pengaturan EQO" data-toggle="" class="no-submenu">
                     <em class="fa fa-balance-scale"></em>
                     <span class="item-text">Pengaturan EQO</span>
                  </a>
               </li>
               <li>
                  <a href="{{route('pengaturan')}}" title="Pengaturan Sistem" data-toggle="" class="no-submenu">
                     <em class="fa fa-cogs"></em>
                     <span class="item-text">Pengaturan Sistem</span>
                  </a>
               </li>
            </ul>
         </nav>
         <!-- END Sidebar (left)-->
      </aside>
      <!-- End aside-->

      <!-- START Main section-->
      <section>
         {% include "inc.messages" %}
         {% block main_content %}

         {% endblock %}
      </section>
      <!-- END Main section-->
   </div>

   {% block page_modal %}

   {% endblock %}

   <!-- END Main wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
   <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
   <!-- <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> -->
   <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
   <!-- Plugins-->
   <script src="{{ asset('vendor/chosen/chosen.jquery.js') }}"></script>
   <script src="{{ asset('vendor/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js') }}"></script>
   <script src="{{ asset('vendor/bootstrap-filestyle/src/bootstrap-filestyle.min.js') }}"></script>
   <!-- Animo-->
   <script src="{{ asset('vendor/animo.js/animo.min.js') }}"></script>
   <!-- Sparklines-->
   <script src="{{ asset('vendor/sparkline/index.js') }}"></script>
   <!-- Slimscroll-->
   <script src="{{ asset('vendor/slimScroll/jquery.slimscroll.min.js') }}"></script>
   <!-- Store + JSON-->
   <script src="{{ asset('vendor/store-js/store%2bjson2.min.js') }}"></script>
   <!-- ScreenFull-->
   <script src="{{ asset('vendor/screenfull/dist/screenfull.min.js') }}"></script>
   <!-- START Page Custom Script-->
   <!--  Flot Charts-->
   <script src="{{ asset('vendor/flot/jquery.flot.js') }}"></script>
   <script src="{{ asset('vendor/flot.tooltip/js/jquery.flot.tooltip.js') }}"></script>
   <script src="{{ asset('vendor/flot/jquery.flot.resize.js') }}"></script>
   <script src="{{ asset('vendor/flot/jquery.flot.pie.js') }}"></script>
   <script src="{{ asset('vendor/flot/jquery.flot.time.js') }}"></script>
   <script src="{{ asset('vendor/flot/jquery.flot.categories.js') }}"></script>
   <script src="{{ asset('vendor/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
   <!-- jVector Maps-->
   <script src="{{ asset('vendor/ika.jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
   <script src="{{ asset('vendor/ika.jvectormap/jquery-jvectormap-us-mill-en.js') }}"></script>
   <script src="{{ asset('vendor/ika.jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
   <!-- END Page Custom Script-->
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

   <script type="text/javascript">
     $(function(){
        if($('.date_picker').length){
           $('.date_picker').datepicker({
             dateFormat:'yy-mm-dd'
           });
        }
     });

     Object.size = function(obj) {
         var size = 0, key;
         for (key in obj) {
             if (obj.hasOwnProperty(key)) size++;
         }
         return size;
     };
   </script>

   {% block page_script %}

   {% endblock %}

   <!-- App Main-->
   <script src="{{ asset('app/js/app.js') }}"></script>
   <!-- END Scripts-->
</body>

</html>
