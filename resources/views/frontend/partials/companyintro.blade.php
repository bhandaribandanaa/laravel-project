@extends('frontend.layouts.app')
@section('cat_detail')
  <!--Page Title-->
  <section class="page-title" style="background-image:url({{asset('frontend/images/background/welcome.jpg')}});">
    <div class="auto-container">
      <div class="title-box">
        <h2>Compaany Introducation</h2>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li>Company Introducation</li>
        </ul>
      </div>
    </div>
  </section>
  <!--End Page Title--> 
  <!--About Section-->
  <div class="sidebar-page-container blog-page">
    <div class="auto-container">
      <div class="row clearfix">    
        <!--Content Side-->
          <div id="main-content" class="site-main clearfix">
            <div id="content-wrap">
                <div id="site-content" class="site-content clearfix">
                    <div id="inner-content" class="inner-content-wrap">
                        <div class="page-content">
                      <section class="wprt-section">
                                <div class="container">
                                   <?php $companyintro = App\Classes\Helper::getCompanyintro();?>
                                <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                                   @foreach($companyintro as $ci)   
                                      {!! $ci->description !!}
                                      @endforeach

                                  <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                                  </div>
                              </section>

                              </div>
                          </div>
            </div>
        </div>
    </div>
        <!--End Sidebar--> 
        
      </div>
    </div>
  </div>
  <!--End About Section--> 
  
@endsection
  