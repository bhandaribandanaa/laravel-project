<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>Nirvana - @yield('title')</title>

{!! Html::style('css/bootstrap.min.css') !!}
{!! Html::style('css/font-awesome.min.css') !!}
{!! Html::style('css/medical-guide-icons.css') !!}
{!! Html::style('css/animate.min.css') !!}
{!! Html::style('css/settings.css') !!}
<!-- REVOLUTION NAVIGATION STYLES -->
    {!! Html::style('css/navigation.css') !!}
    {!! Html::style('css/owl.carousel.css') !!}
    {!! Html::style('css/owl.transitions.css') !!}
    {!! Html::style('css/jquery.fancybox.css') !!}
    {!! Html::style('css/zerogrid.css') !!}
    {!! Html::style('css/style.css') !!}
    {!! Html::style('css/loader.css') !!}
    <link rel="shortcut icon" href="{{url('favicon.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">

    @yield('header_css')

</head>
<body>
<!--Loader-->
{{--<div class="loader">
  <div class="loader__figure"></div>
  <p class="loader__label"><img src="{{url('public/images/logo.png') }}" alt="logo"></p>
</div>--}}


@yield('main')


<!-- Jquery -->

{!! Html::script('js/jquery-2.2.3.js') !!}
{!! Html::script('js/bootstrap.min.js') !!}

{!! Html::script('js/jquery.tools.min.js') !!}
{!! Html::script('js/jquery.revolution.min.js') !!}
{!! Html::script('js/revolution.extension.layeranimation.min.js') !!}
{!! Html::script('js/revolution.extension.navigation.min.js') !!}
{!! Html::script('js/revolution.extension.parallax.min.js') !!}
{!! Html::script('js/revolution.extension.slideanims.min.js') !!}
{!! Html::script('js/revolution.extension.video.min.js') !!}
{!! Html::script('js/slider.js') !!}
{!! Html::script('js/owl.carousel.min.js') !!}
{!! Html::script('js/jquery.parallax-1.1.3.js') !!}

{!! Html::script('js/functions.js') !!}
{!! Html::script('js/parallax.js') !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js"></script>

@yield('footer_js')



</body>
</html>
