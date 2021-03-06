@extends('frontend.layouts.app')
@section('cat_detail')
  <!--About Section-->
  <div class="sidebar-page-container blog-page">
    <div class="auto-container">
      <div class="row clearfix">  
         <div class="about-column col-md-6 col-sm-12 col-xs-12">
                    <?php $aboutnepal= App\Classes\Helper::getAboutNepal(); ?>
                    <div class="text">
                             @foreach($aboutnepal as $an)   
                              {!! $an->description !!}
                              @endforeach
                    </div>      
      </div>
                <!--image Column-->
      <div class="chart-column col-md-6 col-sm-12 col-xs-12">
                   <?php $aboutnepalImg= App\Classes\Helper:: getAboutNepalImg(); ?>
                    <div class="inner-box">
                        <div class="image">
                             @foreach($aboutnepalImg as $ai)   
                              <img src="{{URL::asset('uploads/media/'. $ai->file_name)}}" width="550" heoght="550"alt="">
                              @endforeach
                        </div>
                    </div>
      </div>
      </div>
      </div>
    </div>
  </div>
  <!--End About Section--> 

@endsection
  