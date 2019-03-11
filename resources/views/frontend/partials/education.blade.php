@extends('frontend.layouts.app')
@section('cat_detail')
  <!--About Section-->
  <div class="sidebar-page-container blog-page">
    <div class="auto-container">
      <div class="row clearfix">  
         <div class="about-column col-md-6 col-sm-12 col-xs-12">
                   <?php $education= App\Classes\Helper::getEducation(); ?>
                    <div class="text">
                           @foreach($education as $e)   
                              {!! $e->description !!}
                              @endforeach
                    </div>      
      </div>
                <!--image Column-->
      <div class="chart-column col-md-6 col-sm-12 col-xs-12">
                   <?php $EducationImg= App\Classes\Helper::getEducationImg(); ?>
                    <div class="inner-box">
                        <div class="image">
                             @foreach($EducationImg as $ei)   
                              <img src="{{URL::asset('uploads/media/'. $ei->file_name)}}"  width="550" heoght="450" alt="">
                              @endforeach
                        </div>
                    </div>
      </div>  
      </div>
    </div>
  </div>
  <!--End About Section--> 
  
@endsection
  