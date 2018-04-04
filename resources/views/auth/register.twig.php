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
   <title>BeAdmin - Bootstrap Admin Theme</title>
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries-->
   <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
   <!-- Bootstrap CSS-->
   <link rel="stylesheet" href="{{asset('app/css/bootstrap.css')}}">
   <!-- Vendor CSS-->
   <link rel="stylesheet" href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}">
   <link rel="stylesheet" href="{{asset('vendor/animo.js/animate-animo.css}')}}">
   <!-- App CSS-->
   <link rel="stylesheet" href="{{asset('app/css/app.css')}}">
   <link rel="stylesheet" href="{{asset('app/css/common.css')}}">
   <!-- Modernizr JS Script-->
   <script src="{{asset('vendor/modernizr/modernizr.custom.js')}}" type="application/javascript"></script>
   <!-- FastClick for mobiles-->
   <script src="{{asset('vendor/fastclick/lib/fastclick.js')}}" type="application/javascript"></script>
</head>

<body>
   <!-- START wrapper-->
   <div class="row row-table page-wrapper">
      <div class="col-lg-3 col-md-6 col-sm-8 col-xs-12 align-middle">
         <!-- START panel-->
         <div data-toggle="play-animation" data-play="fadeIn" data-offset="0" class="panel panel-dark panel-flat">
            <div class="panel-heading text-center mb-lg">
               <a href="#">
                  <img src="{{asset('app/img/logo.png')}}" alt="Image" class="block-center img-rounded">
               </a>
               <p class="text-center mt-lg">
                  <strong>SIGNUP TO GET INSTANT ACCESS.</strong>
               </p>
            </div>
            <div class="panel-body">
               <form role="form" method="POST" action="{{ route('register')}}">
                  {{csrf_field()}}
                  <div class="form-group {{ errors.has('name') ? 'has-error' : '' }} has-feedback">
                     <label for="name" class="text-muted">Nama Lengkap</label>
                     <input id="name" type="text" placeholder="Nama Lengkap" class="form-control" value="{{old('name')}}" name="name" required autofocus>
                     <span class="fa fa-envelope form-control-feedback text-muted"></span>
                     {%if error.has('name') %}
                        <span class="help-block">
                            <strong>{{ errors.first('name') }}</strong>
                        </span>
                     {% endif %}
                  </div>
                  <div class="form-group {{ errors.has('email') ? 'has-error' : '' }} has-feedback">
                     <label for="email" class="text-muted">Email</label>
                     <input id="email" type="email" placeholder="Email" class="form-control" required value="{{old('email')}}" name="email">
                     <span class="fa fa-envelope form-control-feedback text-muted"></span>
                     {%if error.has('email') %}
                        <span class="help-block">
                            <strong>{{ errors.first('email') }}</strong>
                        </span>
                     {% endif %}
                  </div>
                  <div class="form-group {{ errors.has('password') ? 'has-error' : '' }} has-feedback">
                     <label for="password" class="text-muted">Password</label>
                     <input id="password" type="password" placeholder="Password" name="password" class="form-control">
                     <span class="fa fa-lock form-control-feedback text-muted"></span>
                  </div>
                  <div class="form-group has-feedback">
                     <label for="password-confirm" class="text-muted">Confirm Password</label>
                     <input id="password-confirm" type="password" placeholder="Retype Password" class="form-control" name="password_confirmation">
                     <span class="fa fa-lock form-control-feedback text-muted"></span>
                  </div>
                  <button type="submit" class="btn btn-block btn-primary">Register</button>
               </form>
            </div>
         </div>
         <!-- END panel-->
      </div>
   </div>
   <!-- END wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
   <script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
   <script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js}')}}"></script>
   <!-- Animo-->
   <script src="{{asset('vendor/animo.js/animo.min.js')}}"></script>
   <!-- Custom script for pages-->
   <script src="{{asset('app/js/pages.js')}}"></script>
   <!-- END Scripts-->
</body>

</html>
