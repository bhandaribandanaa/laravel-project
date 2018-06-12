<header id="site-header" class="header-front-page style-1">
    <div id="site-header-inner" class="container">
        <div class="wrap-inner">
            <div id="site-logo" class="clearfix">
                <div id="site-logo-inner">
                    <a href="{{ route('home') }}" title="Sadik International Oversease" rel="home"
                        class="main-logo">
                    <img src="{{ asset('sadik/img/logo.png') }}" alt="Sadik International Oversease" data-width="100"
                        data-height="30">
                    </a>
                </div>
            </div>
            <!-- /#site-logo -->
            <div class="mobile-button"><span></span></div>
            <!-- //mobile menu button -->
            <nav id="main-nav" class="main-nav">
                <ul class="menu">


                   
                    <li class="active"> <a href="{{URL::to('/')}}" title="Sadik International Oversease" rel="home" class="trail-begin">Home</a>
                    </li>

                  <?php $mainMenus = App\Classes\Helper::getMainMenu(5);
                       $sub_menus = array(); ?>


                    @if(count($mainMenus)>0)
                          @foreach($mainMenus as $mainMenu)
                            @if(count($mainMenu->children)>0)
                                      <?php $sub_menus = $mainMenu->children->lists('slug')->toArray();
                                ?>
                            @endif

                            <li class="active menu-item menu-item-has-children ">
                                <a href="#">{{ $mainMenu->page_title }}</a>

                                @if(count($mainMenu->children)>0)

                                    <ul class="sub-menu">
                                        @foreach($mainMenu->children as $menuChild)


                                        <li class="menu-item">
                                               <a href="{{ route('pages.detail',$menuChild->slug) }}">{{ $menuChild->page_title }}</a>
                                            </li>
                                           
                                        @endforeach
                                    </ul>

                                @endif    
                            </li>
                         @endforeach
                    @endif


                     <li class="active"><a href="{{ route('contacts.add') }}">Contact Us</a></li>
                    <li class="menu-item wprt-button "><a href="{{ route('applyOnline') }}">Apply Online</a></li></li>

                </ul>
            </nav>
            <!-- /#main-nav -->
        </div>
    </div>
    <!-- /#site-header-inner -->
</header>
<!-- /#Header