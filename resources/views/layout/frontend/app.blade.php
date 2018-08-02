<!DOCTYPE html>
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title><?php $settings = App\Classes\Helper::settings(); ?> {{ $settings['website-name'] }}-@yield('title')
    </title>


    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>

    <!-- Theme Style -->
    {{--<link rel="stylesheet" type="text/css" href="assets/css/style.css">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <!-- Favicon and touch icons  -->
    {{--<link rel="shortcut icon" href="assets/icon/favicon.png">--}}
    <link rel="shortcut icon" href="{{ asset('icon/favicon.png') }}">
   <!--  <link rel="shortcut icon" href="{{ asset('css/datatable.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">

</head>

<body class="front-page no-sidebar site-layout-full-width header-style-1 menu-has-search menu-has-cart header-sticky">

<div id="wrapper" class="animsition">
    <div id="page" class="clearfix">

        <div id="site-header-wrap">
            <!-- Top Bar -->
                @include('frontend.partials.top-bar')
            <!-- /#top-bar -->

            <!-- Header -->
                @include('frontend.partials.header')
            <!-- /#Header -->

        </div><!-- /#site-header-wrap -->




    @yield('slider')

        {{--slider end--}}

        <!-- Main Content -->
        @yield('content')


        <!-- Footer -->
        @include('frontend.partials.footer')
        {{--footer end--}}

        <!-- Bottom -->
        @include('frontend.partials.footer_bottom')

    </div><!-- /#page -->
</div><!-- /#wrapper -->

<a id="scroll-top"></a>

<!-- Javascript -->
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/animsition.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/flexslider.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/cube.portfolio.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

<!-- Revolution Slider -->
<script type="text/javascript"
        src="{{ asset('includes/rev-slider/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('includes/rev-slider/js/jquery.themepunch.revolution.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rev-slider.js') }}"></script>
<!-- Load Extensions only on Local File Systems ! The following part can be removed on Server for On Demand Loading -->
<script type="text/javascript"
        src="{{ asset('includes/rev-slider/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('includes/rev-slider/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('includes/rev-slider/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('includes/rev-slider/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('includes/rev-slider/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('includes/rev-slider/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('includes/rev-slider/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('includes/rev-slider/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('includes/rev-slider/js/extensions/revolution.extension.video.min.js') }}"></script>
        <script type="text/javascript"
        src="{{ asset('js/datatable.js') }}"></script>

<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

        <script>
    $(function () {
        $('#demands').DataTable({
            serverSide: true,
            processing: true,
            ajax: '/demandsdata'
        });
    });
</script> -->
<script>
$(document).ready( function () {
    $('#demands').DataTable({
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    "bFilter" : false,               
     "bLengthChange": false

} );
} );
</script>


</body>

</html>

