@extends('frontend.layouts.app')
@section('cat_detail')

  <!--End Page Title--> 
  <!--About Section-->
  <div class="sidebar-page-container blog-page">
    <div class="auto-container">
      <div class="sec-title centered">
          <h3>Vision and Mission</h3>
                
          <div class="separater"></div>
      </div>
        <div class="row clearfix">  
          <div class="about-column col-md-6 col-sm-12 col-xs-12">
                      <?php $innervision= App\Classes\Helper::getInnervision(); ?>
                    <div class="text">
                               @foreach($innervision as $iv)   
                              {!! $iv->description !!}
                              @endforeach
                    </div>      
      </div>
        <div class="chart-column col-md-6 col-sm-12 col-xs-12">
                   <?php $getInnrevisionImg= App\Classes\Helper:: getInnervisionImg(); ?>
                    <div class="inner-box">
                        <div class="image">
                             @foreach($getInnrevisionImg as $vi)   
                              <img src="{{URL::asset('uploads/media/'. $vi->file_name)}}" width="380" height="250" alt="">
                              @endforeach
                        </div>
                    </div>
      </div>  
        
        <!--Content Side-->
  

     

        
        <!--Sidebar-->
        
            
            
       
       
        <!--End Sidebar--> 
        
      </div>
    </div>
  </div>
  <!--End About Section--> 
  
@endsection
  