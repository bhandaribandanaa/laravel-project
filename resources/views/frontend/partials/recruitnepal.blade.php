@extends('frontend.layouts.app')
@section('cat_detail')
  <!--About Section-->
  <div class="sidebar-page-container blog-page">
    <div class="auto-container">
      <div class="row clearfix">  
          <div class="about-column col-md-6 col-sm-12 col-xs-12">
                     <?php $recruitnepal= App\Classes\Helper::getRecruitNepal(); ?>
                    <div class="text">
                              @foreach($recruitnepal as $rn)   
                              {!! $rn->description !!}
                              @endforeach
                    </div>      
      </div>
                <!--image Column-->
      <div class="chart-column col-md-6 col-sm-12 col-xs-12">
                   <?php $getRecruitNepalImg= App\Classes\Helper:: getRecruitNepalImg(); ?>
                    <div class="inner-box">
                        <div class="image">
                             @foreach($getRecruitNepalImg as $ri)   
                              <img src="{{URL::asset('uploads/media/'. $ri->file_name)}}" width="550" height="450" alt="">
                              @endforeach
                        </div>
                    </div>
      </div>  
      </div>
    </div>
  </div>
  <!--End About Section--> 
 
@endsection
  