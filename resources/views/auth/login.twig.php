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
   <title>Login-{{config('app.name')}}</title>
   <link rel="shortcut icon" type="image/png" href="{{asset('app/img/logo-single.png')}}"/>
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries-->
   <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
   <![endif]-->
   <!-- Bootstrap CSS-->
   <link rel="stylesheet" href="{{asset('app/css/bootstrap.css')}}">
   <!-- Vendor CSS-->
   <link rel="stylesheet" href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}">
   <link rel="stylesheet" href="{{asset('vendor/animo.js/animate-animo.css')}}">
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
            <div class="panel-heading text-center">
               <h2>Smart Inventory</h2>
                <p class="text-center mt-lg">
                    <strong>Silahkan Login Untuk Masuk</strong>
                </p>
            </div>
            <div class="panel-body">
               <form role="form" method="POST" action="{{route('login')}}" class="mb-lg">
                  {{csrf_field()}}
                  {#<div class="text-right mb-sm"><a href="{{route('register')}}" class="text-muted">Need to Signup?</a>
                  </div>#}
                  <div class="form-group {{ errors.has('email') ? ' has-error' : '' }} has-feedback">
                     <input id="email" name="email" type="email" placeholder="Enter email" class="form-control" value="{{ old('email') }}">
                     <span class="fa fa-envelope form-control-feedback text-muted"></span>
                     {% if errors.has('email') %}
                        <span class="help-block">
                            <strong>{{ errors.first('email') }}</strong>
                        </span>
                     {% endif %}
                  </div>
                  <div class="form-group {{ errors.has('password') ? ' has-error' : '' }} has-feedback">
                     <input id="password" type="password" name="password" placeholder="Password" class="form-control">
                     <span class="fa fa-lock form-control-feedback text-muted"></span>
                     {% if errors.has('password') %}
                        <span class="help-block">
                            <strong>{{ errors.first('password') }}</strong>
                        </span>
                     {% endif %}
                  </div>
                  <div class="clearfix">
                     <div class="checkbox c-checkbox pull-left mt0">
                        <label>
                           <input type="checkbox" name="remember" value="{{old('remember')}}" {{ old('remember') ? 'checked' : '' }}>
                           <span class="fa fa-check"></span>Remember Me</label>
                     </div>
                     <div class="pull-right"><a href="{{ route('password.request') }}" class="text-muted">Lupa Password?</a>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-block btn-primary">Login</button>
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
   <script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
   <!-- Animo-->
   <script src="{{asset('vendor/animo.js/animo.min.js')}}"></script>
   <!-- Custom script for pages-->
   <script src="{{asset('app/js/pages.js')}}"></script>
   <!-- END Scripts-->
</body>
</html>
