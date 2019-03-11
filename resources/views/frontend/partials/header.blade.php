  <header class="main-header">  
    <!--Header-Upper-->
    <div class="header-upper">
      <div class="auto-container">
        <div class="clearfix">
          <div class="pull-left logo-outer">
            <div class="logo"><a href=""><img src="{{asset('frontend/images/logo.png')}}" ></a></div>
          </div>
          <div class="pull-right upper-right clearfix"> 
            
            <!--Info Box-->
            <div class="upper-column info-box">
              <div class="icon-box"><span class="flaticon-house-outline"></span></div>
              <ul>
                 <?php $settings = App\Classes\Helper::settings(); ?>
                <li><strong>Our Location</strong></li>
                <li>{{ $settings['contact-address']}}</li>
              </ul>
            </div>
            
            <!--Info Box-->
            <div class="upper-column info-box">
              <div class="icon-box"><span class="flaticon-phone-call"></span></div>
              <ul>
                <li><strong>Call Us </strong></li>
                <li>{{ $settings['contact-number']}}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--End Header Upper--> 
    
    <!--Header Lower-->
    <div class="header-lower">
      <div class="auto-container">
        <div class="nav-outer clearfix menu-bg"> 
          <!-- Main Menu -->
          <nav class="main-menu">
            <div class="navbar-header"> 
              <!-- Toggle Button -->
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div class="navbar-collapse collapse clearfix">
              <ul class="navigation clearfix">
                <li ><a href="{{'home'}}">Home</a> </li>
                <li class="dropdown"><a href="{{'about'}}">About Us</a>
                  <?php $aboutus = App\Classes\Helper::getHeaderAbout(); ?>
                  <ul>
                    @if(count($aboutus)>0)
                    @foreach($aboutus as $au)
                    <li><a href="{{$au->slug}}">{{$au->page_title}}</a></li>
                    @endforeach
                    @endif
                  </ul>
                 {{--  <ul>
                     <li><a href="{{'companyintro'}}">Company Introducation</a></li>
                     <li><a href="{{'message'}}">Message From Managing Director</a></li>
                    
                  </ul> --}}
                </li>
                <li ><a href="{{'vision'}}">Vision & Mission</a> </li>
                <li class="dropdown" ><a href="#">Job Categories</a> 
                <?php $jobcategory = App\Classes\Helper::getJobCategories(); ?>
                <ul>
                   @if(count($jobcategory)>0)
                  @foreach($jobcategory as $jc)
                  <li><a href="{{$jc->slug}}">{{$jc->page_title}}</a></li>
                  @endforeach
                  @endif
                </ul> 
                {{--   <ul>
                     <li><a href="{{'professional'}}">Professional</a></li>
                     <li><a href="{{'cat_detail'}}">Skilled Labor</a></li>
                     <li><a href="{{'semi-skilled-labor'}}">SemiSkilled Labor</a></li>
                     <li><a href="{{'unskilled-labor'}}">UnSkilled Labor</a></li>
                     <li><a href="{{'hotelservice-industry'}}">Hotel/Service Industry</a></li>
                     <li><a href="{{'domestic-maid'}}">Domestic</a></li>
                  </ul> --}}
                </li>
                <li ><a href="{{'procedure'}}">Business Procedure</a> </li>
                <li ><a href="{{'contact'}}">Contact Us</a> </li>
              </ul>
            </div>
          </nav>
          <!-- Main Menu End-->
          <div class="btn-box"> <a href="#" class="brochure-btn theme-btn"><span class="icon fa fa-download theme_color"></span>&nbsp; Download Brochures</a> </div>
        </div>
      </div>
    </div>
    <!--End Header Lower--> 
    
  </header>