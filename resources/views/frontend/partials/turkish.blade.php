@extends('frontend.layouts.app')
@section('cat_detail')
  <!--About Section-->
  <div class="sidebar-page-container blog-page">
    <div class="auto-container">
      <div class="row clearfix">  
      <div class="about-column col-md-6 col-sm-12 col-xs-12">
                    <?php $turkish= App\Classes\Helper::getTurkish(); ?>
                    <div class="text">
                        @foreach($turkish as $t)   
                              {!! $t->description !!}
                              @endforeach
                    </div>
                    
                </div>
                <!--image Column-->
                <div class="chart-column col-md-6 col-sm-12 col-xs-12">
                   <?php $turkishImg= App\Classes\Helper::getTutkishImg(); ?>
                    <div class="inner-box">
                        <div class="image">
                             @foreach($turkishImg as $ti)   
                              <img src="{{URL::asset('uploads/media/'. $ti->file_name)}}" width="550" heoght="280" alt="">
                              @endforeach
                        </div>
                    </div>
                </div>
      </div>
    </div>
  </div>
  <!--End About Section--> 

@endsection
  