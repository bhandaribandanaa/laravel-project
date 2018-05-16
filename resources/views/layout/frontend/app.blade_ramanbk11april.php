<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>Society Of Internal Medicine of Nepal ( SIMON ) - @yield('title')</title>
    <!-- Materialize CSS  -->
    {!! Html::style('css/materialize.css') !!}
            <!-- Custom Css -->
    {!! Html::style('css/style.css') !!}
            <!-- Font Awesome Css -->
    {!! Html::style('css/font-awesome.min.css') !!}
            <!-- Slider Css -->
    {!! Html::style('css/pgwslider.css') !!}
    {!! Html::style('css/camera.css') !!}
    {!! Html::style('css/stacktable.css') !!}
    {!! HTML::style('http://fonts.googleapis.com/css?family=Lobster') !!}
    {!! HTML::style('https://fonts.googleapis.com/icon?family=Material+Icons') !!}

    @yield('header_css')

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {!! Html::script('js/html5shiv.js') !!}
    {!! Html::script('js/respond.min.js') !!}
    <![endif]-->
    <div id="fb-root"></div>
    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=305199232931063";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    @yield('header_js')

</head>
<body>
<div id="fb-root"></div>
<!-- Header -->
<header>
    <!-- Header Top Display In large and Tablet Device -->
    <div class="header-top hide-on-small-only">
        <div class="container">
            <div class="row">

                <div class="col l8 col m7 col s12">
                    <!-- Logo -->
                    <div class="logo"><a href="{{ route('home') }}"><img src="{{ url('images/logo.png') }}"
                                                                         alt="SIMON"></a></div>
                </div>
                <div class="col l4 col m5 col s12 pull-right">


                    <div class="">


                        @if (Auth::check() &&  Auth::user()->user_type=="3" )
                            <div class="you">You are login as:
                                <strong>{{ Auth::user()->salutation.' '.Auth::user()->first_name.' '.Auth::user()->last_name }}</strong>
                            </div>
                            <div class="login_link">
                                <ul>
                                    <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
                                    <li><a href="{{ route('member.profile.edit') }}">Edit Profile</a></li>
                                    <li><a href="{{ route('member.logout') }}">Log Out</a></li>
                                </ul>
                            </div>

                        @else
                            <div class="loginbtn"><a class="btn btn-flat link waves-effect waves-light "
                                                     href="{{ route('member.login') }}">Login</a></div>

                        @endif
                    </div>
                    <!-- Search Button -->
                    <form class="searchbox" style="display:none">
                        <input type="text" placeholder="Type and Press Enter" name="search" class="searchbox-input"
                               required>
                        <input type="submit" class="searchbox-submit">
                        <span class="searchbox-icon"><i class="mdi-action-search"></i></span>
                    </form>
                    <!-- LogIn Link -->

                </div>
            </div>
        </div>
    </div>
    <!-- Header top Display On Mobile -->
    <div class="header hide-on-med-and-up">
        <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col l2 col m2 col s12"><a href="#" data-activates="slide-out"
                                                          class="button-collapse show-on-large"><i
                                    class="mdi-navigation-menu"></i></a></div>
                    <div class="col l8 col m8 col s12">
                        <!-- Logo -->
                        <div class="logo"><a href="{{ route('home') }}"><img src="{{ url('images/logo_small.png') }}"
                                                                             alt="SIMON"></a></div>
                    </div>
                    <div class="col l2 col m2 col s12 pull-right">
                        <div class="loginbtn">


                            @if (Auth::check() &&  Auth::user()->user_type=="3" )
                                <a class="btn btn-flat link waves-effect waves-light "
                                   href="{{ route('member.dashboard') }}">Dashboard</a>
                            @else
                                <a class="btn btn-flat link waves-effect waves-light "
                                   href="{{ route('member.login') }}">Login</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Navigation -->
    <nav role="navigation" class="hide-on-small-only">
        <div class="container">

            <div class="nav-wrapper menu-category">
                <ul>
                    <li><a href="{{ route('home') }}">Home </a></li>
                    <li>
                        <ul class="news-category-dropdown">
                            <li><a href="javascript:void(0)">About <i class="fa fa-angle-down"></i></a>
                                <?php $aboutPages = \App\Classes\Contents::getContentByParentId(1); ?>
                                @if(count($aboutPages)>0)
                                    <ul>
                                        @foreach($aboutPages as $aboutpage)
                                            <li>
                                                <a href="{{ route('pages.detail',$aboutpage->slug) }}">{{ $aboutpage->page_title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul class="news-category-dropdown">
                            <li><a href="javascript:void(0);">Members <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="{{ route('member.life.members') }}">Life Members</a></li>
                                    <li><a href="{{ route('member.associate.members') }}">Associate Members</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul class="news-category-dropdown">
                            <li><a href="javascript:void(0);">Events<i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <?php $eventsTypes = \App\Classes\Helper::getEventTypes(); ?>
                                    @if(count($eventsTypes)>0)
                                        @foreach($eventsTypes as $eventType)
                                            <li>
                                                <a href="{{ route('events.type.index',$eventType->slug ) }}">{{ $eventType->name }}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('gallery.index') }}">Photo Gallery </a>
                    </li>
                    <li>
                        <ul class="news-category-dropdown">
                            <li><a href="javascript:void(0);">Downloads <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="{{ route('download.files') }}">File</a></li>
                                    <li><a href="{{ route('download.videos') }}">Video</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('pages.contact_us') }}">Contact </a>
                    </li>


                    {{--<li class="register">--}}
                    <?php // $comingEvent = \App\Classes\Helper::getUpcomingEvent(); ?>
                    {{--@if(count($comingEvent)>0)--}}
                    {{--<a href="{{ route('event.registration',array($comingEvent->id,$comingEvent->slug)) }}">Registration </a>--}}
                    {{--@endif--}}
                    {{--</li>--}}
                </ul>
            </div>

        </div>
    </nav>
</header>
<!-- Sidebar Navigation -->
<ul id="slide-out" class="side-nav full">
    <!-- Dropdown Menu -->
    <li class="dropdown-menu">
        <ul class="collapsible" data-collapsible="expandable">

            @if (Auth::check() &&  Auth::user()->user_type=="3" )
                <?php $memberInfo= \App\Classes\Helper::getMemberInfo(Auth::user()->member_id); ?>
                <div class="side_user_info">
                    <img
                            @if($memberInfo->member_photo && file_exists('uploads/member/'. $memberInfo->member_photo))
                            src="{{URL::asset('uploads/member/'. $memberInfo->member_photo) }}"
                            @else
                            src="{{ URL::asset('images/no-profile-img.gif') }}"
                            @endif
                            class="responsive-img circle side_profile_img">

                    <div class="sidename">{{ Auth::user()->salutation.' '.Auth::user()->first_name.' '.Auth::user()->middle_name.' '.Auth::user()->last_name  }}</div>
                </div>
            @endif

            <li class=""><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home Page</a></li>
            <li class="">
                <div class="collapsible-header waves-effect waves"><i class="fa fa-file-text"></i>About<i class="fa fa-angle-right"></i></div>
                <div style="display: none;" class="collapsible-body">
                    <?php $aboutPages = \App\Classes\Contents::getContentByParentId(1); ?>
                    @if(count($aboutPages)>0)
                        <ul>
                            @foreach($aboutPages as $aboutpage)
                                <li>
                                    <a href="{{ route('pages.detail',$aboutpage->slug) }}">{{ $aboutpage->page_title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </li>
            <li class="">
                <div class="collapsible-header waves-effect waves"><i class="fa fa-users"></i>Members <i class="fa fa-angle-right"></i></div>
                <div style="display: none;" class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('member.life.members') }}">Life Members</a></li>
                        <li><a href="{{ route('member.associate.members') }}">Associate Members</a></li>
                    </ul>
                </div>
            </li>
            <li class="">
                <div class="collapsible-header waves-effect waves"><i class="fa fa-calendar"></i> Events <i class="fa fa-angle-right"></i></div>
                <div style="display: none;" class="collapsible-body">
                    <ul>
                        <?php $eventsTypes = \App\Classes\Helper::getEventTypes(); ?>
                        @if(count($eventsTypes)>0)
                            @foreach($eventsTypes as $eventType)
                                <li>
                                    <a href="{{ route('events.type.index',$eventType->slug ) }}">{{ $eventType->name }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </li>
            <li class="waves-effect"><a href="{{ route('gallery.index') }}"><i class="fa fa-picture-o"></i> Photo Gallery</a></li>


            <li class="">
                <div class="collapsible-header waves-effect waves"><i class="fa fa-download"></i> Downloads <i class="fa fa-angle-right"></i></div>
                <div style="display: none;" class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('download.files') }}">File</a></li>
                        <li><a href="{{ route('download.videos') }}">Video</a></li>
                    </ul>
                </div>
            </li>
            <li class="waves-effect"><a href="{{ route('pages.contact_us') }}"><i class="fa fa-envelope"></i> Contact</a></li>

            @if (Auth::check() &&  Auth::user()->user_type =="3")
                <div class="divider_side"></div>
                <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('member.profile.edit') }}">Edit Profile</a></li>
                <li><a href="{{ route('member.logout') }}">Log Out</a></li>
            @else
                <div class="divider_side"></div>
                <li><a href="{{ route('member.login') }}">Login</a></li>

            @endif
            {{--<li class="register">--}}
            <?php //$comingEvent = \App\Classes\Helper::getUpcomingEvent(); ?>
            {{--@if(count($comingEvent)>0)--}}
            {{--<a href="{{ route('event.registration',array($comingEvent->id,$comingEvent->slug)) }}">Registration </a>--}}
            {{--@endif--}}
            {{--</li>--}}
        </ul>
    </li>
</ul>
<!-- Main Wrapper -->
<div class="wrapper">
    @yield('main')
</div>
<!-- Footer -->
<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 m12 col s12 gp_m">
                <div class="footer-title">Quick Links</div>
                <!-- Footer Column 1 -->
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('pages.detail','about-simon') }}">About Us </a></li>
                    <li><a href="{{ url('images/journal.pdf') }}" target="_blank">Download </a></li>
                    <li><a href="{{ route('gallery.index') }}">Video Gallery</a></li>
                    <li><a href="javascript:void(0);">News & Announcement</a></li>
                </ul>
                <ul>
                    <li><a href="{{ url('images/journal.pdf') }}" target="_blank">Journal</a></li>
                    <li><a href="{{ route('member.life.members') }}">Life Members</a></li>
                    <li><a href="{{ route('member.associate.members') }}">Associate Members</a></li>
                    <li><a href="{{ route('pages.gallery') }}">Photo Gallery</a></li>
                    <li><a href="{{ route('pages.contact_us') }}">Contact </a></li>
                </ul>
            </div>
            <div class="col l3 m6  s12 gp_m">
                <form method="post" id="reg-form">
                    <div class="footer-title">Subscribe Newsletter</div>
                    <p class="small">Signup to our newsletter or connect via<br> social networks</p>

                    <div class="status" id="status">

                    </div>
                    <div class="input-field">
                        <input id="newsletter" type="email" name="email" class="validate" required="required">
                        <label for="newsletter">Enter Your Email Address</label>
                    </div>
                    <button class="btn btn-flat waves-effect waves-light " type="submit" name="action">Submit</button>
                    {!! csrf_field() !!}
                </form>
                <!-- Social Icon -->
                <div class="social-icon"><a href="https://www.facebook.com/simonnepal" target="_blank"><i
                                class="fa fa-facebook"></i></a> <a href="javascript:void(0);"><i
                                class="fa fa-twitter"></i></a>
                    <a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a> <a href="javascript:void(0);"><i
                                class="fa fa-google-plus"></i></a></div>
            </div>
            <div class="col l3 m6  s12">
                <div class="footer-title">Contact Us</div>
                Janakalyan Sadan, Babarmahal, <br>
                Kathmandu, Nepal<br>
                <br>
                +977- 1 - 4251911, 9851206644 <br>
                <br>
                <a href="mailto:simonnepal@gmail.com">simonnepal@gmail.com</a> <br>
                <a href="mailto:simoncon15@gmail.com">simoncon15@gmail.com</a></div>
        </div>
    </div>
    <!-- Footer Bottom -->
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <!-- Copyright Text -->
                <div class="col l6 col m8 col s12"> Copyright &copy; 2016 SIMON - Society of internal Medicine of
                    Nepal.
                </div>
                <div class="col l6 col m4 col s12 powered"> Powered by <a
                            href="http://www.peacenepal.com.np" target="_blank"> Peace Nepal DOT Com</a></div>
            </div>
        </div>
    </div>
</footer>
<!-- Jquery -->
{!! Html::script('js/jquery-min.js') !!}
        <!-- Materialize JS -->
{!! Html::script('js/materialize.js') !!}
        <!-- Plugin JS -->
{!! Html::script('js/pgwslider.js') !!}
{!! Html::script('js/jquery.touchSwipe.min.js') !!}
{!! Html::script('js/jquery.liquid-slider.js') !!}
{!! Html::script('js/camera.js') !!}
{!! Html::script('js/stacktable.js') !!}

<script>
    $(document).on('click', '#run', function (e) {
        e.preventDefault();
        $('#simple-example-table').stacktable();
        $(this).replaceWith('<span>ran - resize your window to see the effect</span>');
    });
    $('#responsive-example-table').stacktable({myClass: 'your-custom-class'});
    $('#card-table').cardtable();
    $('#agenda-example').stackcolumns();
</script>


<!-- Custom Js -->
{!! Html::script('js/init.js') !!}

@yield('footer_js')

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('submit', '#reg-form', function () {
            var data = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '{{ route('subscribe.newsletter') }}',
                data: data,
                success: function (data) {
                    $("#status").html(data.message);
                }
            });
            return false;
        });

    });
</script>
</body>
</html>