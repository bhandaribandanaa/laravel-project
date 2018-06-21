<!DOCTYPE html>
<!--[if IE 9 ]>
<html class="ie9"><![endif]--><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $settings = App\Classes\Helper::settings(); ?> {{ ($settings)['website-name'] }}- @yield('title')</title>
     
    <link rel="shortcut icon" href="{{ asset('icon/favicon.png') }}">
    <!-- Vendor CSS -->
    
    {!! Html::style('http://fontawesome.io/assets/font-awesome/css/font-awesome.css') !!}
    {!! Html::style('backend/plugins/animate.css/animate.min.css') !!}
    {{--    {!! Html::style('back/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css') !!}--}}
    {!! Html::style('backend/plugins/bootstrap-sweetalert/lib/sweet-alert.css') !!}
    {{--    {!! Html::style('back/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css') !!}--}}
    {{--    {!! Html::style('backend/plugins/bootstrap-sweetalert/lib/sweet-alert.css') !!}--}}
    {!! Html::style('backend/plugins/bootstrap-sweetalert/lib/sweetalert2.css') !!}
    {{--{!! Html::style('backend/sweetAlert/sweetalert.css') !!}--}}
    {!! Html::style('backend/plugins/material-design-iconic-font/css/material-design-iconic-font.min.css') !!}
            <!-- CSS -->

    @yield('header_css')

    {!! Html::style('backend/css/app.min.1.css') !!}
    {!! Html::style('backend/css/app.min.2.css') !!}
    {!! Html::style('backend/css/style.css') !!}
    {!! Html::script('backend/js/jquery.min.js') !!}

    @yield('header_js')
    
<style type="text/css">
    .main-menu > li.sub-menu > ul > li > a i{ margin-right:5px;     width: 15px;}
	.profile-pic, .profile-info{ display:none;}
	.profile-menu > a { display: block;height: 95px;margin-bottom: 0px;width: 100%;background-size: 100%;}
	.main-menu {list-style: none;padding-left: 0;margin: 0px 0 0;}
	.top-menu > li > a.tm-doc {background-image: url({{ asset('img/doc.png') }});}
	.top-menu > li > a.tm-package{background-image: url({{ asset('img/packages.png') }});}
	hr {margin-top: 0px;margin-bottom: 0px;border: 0;border-top: 1px solid #eee;}
    .mainname{ color: #2196F3;}
	.lv-header {background: #f8f8f8;}
	.dropdown-menu.dm-icon > li > a > i{ width:31px !important; text-align:center;}
	.card2 .card-header h2 {
    margin: 0;
    line-height: 100%;
    font-size: 15px;
    font-weight: 400; text-align:center;
}

.card .card-header{
    padding: 15px 20px !important; font-weight: 500;
}
.count {
    font-size: 57px !important;
    text-align: center;
    padding: 10px 15px !important;
}
.actions{ display:none;}
    </style>
</head>
<body>
<header id="header">
    <ul class="header-inner">
        <li id="menu-trigger" data-trigger="#sidebar">
            <div class="line-wrap">
                <div class="line top"></div>
                <div class="line center"></div>
                <div class="line bottom"></div>
            </div>
        </li>

        <li class="logo hidden-xs">
            <a href="{{ route('admin.dashboard') }}">Sadik Admin</a>
        </li>

        <li class="pull-right">
            <ul class="top-menu">
                <li id="toggle-width">
                    <div class="toggle-switch">
                        <input id="tw-switch" type="checkbox" hidden="hidden">
                        <label for="tw-switch" class="ts-helper"></label>
                    </div>
                </li>

                <li class="dropdown hidden-xs">
                    <a data-toggle="dropdown" class="tm-doc" href=""></a>
                   

                <li class="dropdown">
                    <a data-toggle="dropdown" class="tm-settings" href=""></a>
                    <ul class="dropdown-menu dm-icon pull-right">

                        <li class="hidden-xs">
                            <a href="{{ route('admin.users.profile') }}"><i class="zmdi zmdi-account"></i>Update Profile</a>
                        </li>
                        <li class="hidden-xs">
                            <a href="{{ route('admin.users.change_password') }}"><i
                                        class="zmdi zmdi-key zmdi-hc-fw"></i>Change
                                Password</a>
                        </li>

                        <li class="hidden-xs">
                            <a href="{{ route('admin.logout') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a>
                        </li>

                    </ul>
                </li>

                </li>
            </ul>

</header>

<section id="main">

    @include('admin.layout.sidebar')

    <section id="content">

        @yield('main')


    </section>
</section>

<footer id="footer">
    Copyright &copy; {{ date('Y') }} PNDC Admin

    <ul class="f-menu">
        <li><a href="">Home</a></li>
        <li><a href="">Dashboard</a></li>
        <li><a href="">Reports</a></li>
        <li><a href="">Support</a></li>
        <li><a href="">Contact</a></li>
    </ul>
</footer>

<!-- Older IE warning message -->
<!--[if lt IE 9]>
<div class="ie-warning">
    <h1 class="c-white">Warning!!</h1>

    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
        to access this website.</p>

    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="img/browsers/chrome.png" alt="">

                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="img/browsers/firefox.png" alt="">

                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="img/browsers/opera.png" alt="">

                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="img/browsers/safari.png" alt="">

                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="img/browsers/ie.png" alt="">

                    <div>IE (New)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->

<!-- Javascript Libraries -->
{!! Html::script('backend/plugins/bootstrap/dist/js/bootstrap.min.js') !!}
{!! Html::script('backend/plugins/flot/jquery.flot.js') !!}
{!! Html::script('backend/plugins/flot/jquery.flot.resize.js') !!}
{!! Html::script('backend/plugins/flot.curvedlines/curvedLines.js') !!}
{!! Html::script('backend/plugins/sparklines/jquery.sparkline.min.js') !!}
{!! Html::script('backend/plugins/moment/min/moment.min.js') !!}
{!! Html::script('backend/plugins/simpleWeather/jquery.simpleWeather.min.js') !!}
{!! Html::script('backend/plugins/jquery.nicescroll/jquery.nicescroll.min.js') !!}
{!! Html::script('backend/plugins/jquery-placeholder/jquery.placeholder.min.js') !!}
{!! Html::script('backend/plugins/Waves/dist/waves.min.js') !!}
{!! Html::script('backend/plugins/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') !!}
{!! Html::script('backend/plugins/fullcalendar/dist/fullcalendar.min.js') !!}
{{--{!! Html::script('backend/plugins/bootstrap-sweetalert/lib/sweet-alert.min.js') !!}--}}
{!! Html::script('backend/plugins/bootstrap-sweetalert/lib/sweetalert2.min.js') !!}
{{--{!! Html::script('backend/sweetAlert/sweetalert.min.js') !!}--}}
{!! Html::script('backend/plugins/bootstrap-growl/bootstrap-growl.min.js') !!}
<!--[if IE 9 ]>
{!! Html::script('backend/plugins/jquery-placeholder/jquery.placeholder.min.js') !!}
<![endif]-->
{!! Html::script('backend/js/flot-charts/curved-line-chart.js') !!}
{!! Html::script('backend/js/flot-charts/line-chart.js') !!}
{!! Html::script('backend/js/charts.js') !!}
{!! Html::script('backend/js/functions.js') !!}
{{--{!! Html::script('backend/js/demo.js') !!}--}}

<script>
    var siteAdminURL = '{{ URL("admin") }}/';
    var AdminAssetPath = '{{ asset("backend") }}/';
</script>

@yield('footer_js')

</body>
</html>