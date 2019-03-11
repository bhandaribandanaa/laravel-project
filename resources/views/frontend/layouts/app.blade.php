<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Euro Nepal</title>
<!-- Stylesheets -->
<link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('frontend/plugins/revolution/css/settings.css')}}" rel="stylesheet" type="text/css">
<!-- REVOLUTION SETTINGS STYLES -->
<link href="{{asset('frontend/plugins/revolution/css/layers.css')}}" rel="stylesheet" type="text/css">
<!-- REVOLUTION LAYERS STYLES -->
<link href="{{asset('frontend/plugins/revolution/css/navigation.css')}}" rel="stylesheet" type="text/css">
<!-- REVOLUTION NAVIGATION STYLES -->
<link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">

<!--Favicon-->

<link rel="icon" type="image/png"  href="{{asset('frontend/images/favicon.png')}}">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>
<div class="page-wrapper">
	 <div class="preloader"></div>
	 <div>
	 	@include('frontend.partials.header')
	 </div>
	 <div>
	 	@yield('content')
	 	@yield('contact')
	 	@yield('cat_detail')
	 	@yield('companyintro')
	 </div>
	 <div>
	 	@include('frontend.partials.footer')
	 </div>
</div>

<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-long-arrow-up"></span></div>
<script src="{{asset('frontend/js/jquery.js')}}"></script> 
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('frontend/js/owl.js')}}"></script> 
<script src="{{asset('frontend/js/appear.js')}}"></script> 
<script src="{{asset('frontend/js/wow.js')}}"></script> 
<script src="{{asset('frontend/js/script.js')}}"></script> 


<!--Revolution Slider--> 
<script src="{{asset('frontend/plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script> 
<script src="{{asset('frontend/plugins/revolution/js/jquery.themepunch.tools.min.js')}}"></script> 
<script src="{{asset('frontend/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script> 
<script src="{{asset('frontend/plugins/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script> 
<script src="{{asset('frontend/plugins/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script> 
<script src="{{asset('frontend/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script> 
<script src="{{asset('frontend/js/main-slider-script.js')}}"></script>
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery-3.2.1.js')}}"></script>
<script src="{{asset('frontend/js/jquery.raty.min.js')}}" type="text/javascript"></script>
</body>
</html>



