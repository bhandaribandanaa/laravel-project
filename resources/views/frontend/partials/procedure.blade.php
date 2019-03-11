@extends('frontend.layouts.app')
@section('cat_detail')
  <!--End Page Title--> 
  <!--About Section-->
   <section class="page-title" style="">
    <div class="auto-container">
      <div class="separater">
        <h2>Business Procedure</h2>
      </div>
    </div>
  </section>
  <div class="sidebar-page-container blog-page">
    <div class="auto-container">
          <div class="row clearfix"> 
        
        <!--Content Side-->
       
        <div id="main-content" class="site-main clearfix">
    <div id="content-wrap">
        <div id="site-content" class="site-content clearfix">
            <?php $procedure = App\Classes\Helper::getProcedure(); ?>
            <div id="inner-content" class="inner-content-wrap">
                <div class="page-content">
              <section class="wprt-section">
                        <div class="container">
                        <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                         @foreach($procedure as $p)    
                         {!! $p->description !!}
                         @endforeach
                         <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                        </div>
              </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
      </div>
    </div>
  </div>
  <!--End About Section--> 
  
@endsection
  