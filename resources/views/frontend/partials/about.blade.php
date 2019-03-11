@extends('frontend.layouts.app')
@section('cat_detail')
  
  <!--Page Title-->
  <section class="page-title" style="background-image:url({{asset('frontend/images/background/welcome.jpg')}});">
    <div class="auto-container">
      <div class="title-box">
        <h2>About Us</h2>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li>About Us</li>
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
         <?php $aboutus = App\Classes\Helper::getAbtus(); ?>
            <div class="about-column col-md-6 col-sm-12 col-xs-12">
               @foreach($aboutus as $a)
                  
                    <div class="text">
                        {!!$a->description!!}
                    </div>
                 @endforeach   
                </div>
                 <div class="chart-column col-md-6 col-sm-12 col-xs-12">
                    <?php $abtimg = App\Classes\Helper::getAbtusImg(); ?> 
                    <div class="inner-box">
                        <div class="image">
                              @foreach($abtimg as $abt)
                              <img src="{{URL::asset('uploads/media/'. $abt->file_name)}}" alt="">
                              @endforeach
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
  