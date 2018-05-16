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

    <!--Topbar-->
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-5">
            
              <ul class="topmenu">

                <?php $mainMenus = App\Classes\Helper::getMainMenu(5);
                    $sub_menus = array(); ?>

                    @if(count($mainMenus)>0)
                          @foreach($mainMenus as $mainMenu)
                            @if(count($mainMenu->children)>0)
                                      <?php $sub_menus = $mainMenu->children->lists('slug')->toArray();
                                ?>
                            @endif
                  <li class="dropdown {{ (Request::segment(1) == 'pages' && (Request::segment(2) == $mainMenu->slug || in_array(Request::segment(2), $sub_menus))) ? 'active' : '' }}" class="">
<a href="@if(count($mainMenu->children)>0)javascript:void(0);@else {{ route('pages.detail',$mainMenu->slug) }}@endif">{{ $mainMenu->page_title }}</a>
                    @if(count($mainMenu->children)>0)
                      <ul class="dropdown-menu" >
                        @foreach($mainMenu->children as $menuChild)
                            <li>
                                <a href="{{ route('pages.detail',$menuChild->slug) }}">{{ $menuChild->page_title }}</a>
                            </li>
                        @endforeach
                      </ul>
                    @endif
                  </li>
              @endforeach
            @endif
            
            <li><a href="{{ route('news')}}">News</a></li>
            
            <li><a href="{{ route('gallery')}}">Gallery</a></li>
            
                <li class="{{ (Request::segment(1) == 'pages' && Request::segment(2) == 'contact-us') ? 'active' : '' }}"><a href="{{ route('pages.contact_us')}}">Contact Us</a></li>
              </ul>
           
          </div>
          <div class="col-xs-12 col-sm-6 col-md-7">
            
            <p class="pull-right hidden-xs"><i class="fa fa-phone"></i> Kathmandu: +977-1-4001121, 4416434&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<i class="fa fa-phone"></i> Lalitpur: +977-1-5530443, 5542121 </p>
          </div>
        </div>
      </div>
    </div>
    

    <!--Header-->
    <header id="main-navigation">
      <div id="navigation"  data-offset-top="20">
        <div class="container">
          <div class="row">
          <div class="col-md-12">
            <nav class="navbar navbar-default">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#fixed-collapse-navbar" aria-expanded="false"> 
                <span class="icon-bar top-bar"></span> <span class="icon-bar middle-bar"></span> <span class="icon-bar bottom-bar"></span> 
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ url('images/logo.png') }}" class="img-responsive" alt="logo">
                </a> 
             </div>
            
                <div id="fixed-collapse-navbar" class="navbar-collapse collapse navbar-right">
                  <ul class="nav navbar-nav">
                    <li class=" {{ (Request::segment(1) == 'home' || !Request::segment(1)) ? 'active' : '' }}">
                       <a href="{{ route('home') }}" >Home</a>
                       
                    </li>

                    <li><a href="{{ route('services') }}">Available Services</a></li>
                    <li><a href="{{ route('packages') }}">Health Checkup Packages</a></li>
                    <li><a class="bookappointment" href="{{ route('doctors') }}">Book an Appointment</a></li>
                  </ul>
                </div>
             </nav>
             </div>
           </div>
         </div>
      </div>
    </header>

    @yield('main')

    <!--Footer-->
    <footer class="padding-top bg_blue">
      <div class="container">
        <div class="row">
          
          <div class="col-md-3  col-sm-6 footer_column">
            <h4 class="heading">Quick Links</h4>
            <hr class="half_space">
            <ul class="widget_links">
              <li><a href="{{ route('home') }}">Home</a></li>
              <?php $footerMenus = \Modules\Content\Entities\Content::listFooterMenus();
              foreach($footerMenus as $footer) {
              ?>
                <li><a href="{{ route('pages.detail',$footer->slug) }}">{{$footer->page_title}}</a></li>
              <?php } ?>
              <li><a href="{{ route('news') }}">News</a></li>
              <li><a href="{{ route('gallery') }}">Gallery</a></li>
              <li><a href="{{ route('services') }}">Services</a></li>
              <li><a href="{{ route('packages') }}">Packages</a></li>
              <li><a href="{{ route('pages.contact_us') }}">Contact Us</a></li>
            </ul>
          </div>
          
          <div class="col-md-3 col-sm-6 footer_column">
            <h4 class="heading">Kathmandu Branch</h4>
            <hr class="half_space">
            <p class="address"><i class="icon-location"></i>Lazimpat, Uttar Dhoka, Kathmandu, Nepal</p>
         
            <p class="address"><i class="fa fa-phone"></i><a href="tel:01-4001121">+977-1-4001121</a>, <a href="tel:01-4416434">4416434</a></p>
            <p class="address"><i class="icon-dollar"></i><a href="mailto:info@nirvanawellnessclinic.com">info@nirvanawellnessclinic.com</a></p>
            <p class="address"><i class="fa fa-globe"></i><a href="http://www.nirvanawellnessclinic.com/">www.nirvanawellnessclinic.com</a></p>
          </div>
          <div class="col-md-3 col-sm-6 footer_column">
            <h4 class="heading">Lalitpur Branch</h4>
            <hr class="half_space">
            <p class="address"><i class="icon-location"></i>Shaligram Village Complex
    Jawalakhel, Lalitpur</p>
            
            <p class="address"><i class="fa fa-phone"></i><a href="tel:01-5530443"></a>+977-1-5530443, <a href="tel:01-5542121">5542121</a></p>
            <p class="address"><i class="icon-dollar"></i><a href="mailto:info@nirvanawellnessclinic.com">info@nirvanawellnessclinic.com</a></p>
            <p class="address"><i class="fa fa-globe"></i><a href="http://www.nirvanawellnessclinic.com/">www.nirvanawellnessclinic.com</a></p>
          </div> 
          <div class="col-md-3 col-sm-6 footer_column">
            <h4 class="heading">Newsletter</h4>
            <hr class="half_space">
            <p class="icon"><i class="icon-dollar"></i>Sign up with your name and email to get updates fresh updates.</p>
            <div id="result1" class="text-center"></div>        

           <form action="{{route('subscribe.newsletter') }}" method="post" onSubmit="return false" class="newsletter">
              <div class="form-group">
                <input type="email" placeholder="E-mail Address" required name="EMAIL" id="EMAIL" class="form-control" />
                {!! csrf_field() !!}
              </div>
              <div class="form-group">
                <input type="submit" class="btn-submit button3" value="Subscribe" />
              </div>
            </form>
          </div>
        </div>
        <div class="row">
         <div class="col-md-12">
            <div class="copyright clearfix">
              <p>Copyright &copy; 2017 Nirvana Wellness Clinic. All Rights Reserved&nbsp;|&nbsp;<a href="http://peacenepal.com.np/" target="_blank">Powered by: PNDC</a></p>
              <ul class="social_icon">
                   <li><a href="http://www.fb.com/nirvanawellnessclinic" class="facebook" target="_blank"><i class="icon-facebook5"></i></a></li>
                   <!-- <li><a href="#" class="twitter"><i class="icon-twitter4"></i></a></li>
                   <li><a href="#" class="google"><i class="icon-google"></i></a></li>-->
                  </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <a href="#" id="back-top"><i class="fa fa-angle-up fa-2x"></i></a>
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
